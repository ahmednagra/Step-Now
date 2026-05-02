<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

/**
 * StepNow — Admin dashboard controller (Wave 4).
 *
 * Supplies aggregate statistics + recent-activity feed to the dashboard.
 * Defensive everywhere — every table is checked with Schema::hasTable
 * before query, so the dashboard never 500s on a fresh database.
 *
 * If the existing `Admin\DashboardController` lives elsewhere or has
 * extra responsibilities, MERGE the methods of this class into it
 * rather than blindly replacing — this file is written as a complete
 * controller you can drop in if you don't have one.
 */
class DashboardController extends Controller
{
    /**
     * GET /admin/dashboard
     */
    public function index()
    {
        $stats     = $this->stats();
        $recent    = $this->recentActivity();
        $chart     = $this->bookingsLast30Days();
        $pending   = $this->pendingCounts();

        return view('admin.dashboard', compact('stats', 'recent', 'chart', 'pending'));
    }

    /* =====================================================================
     * KPI cards data
     * ===================================================================== */

    private function stats(): array
    {
        $today = Carbon::today();
        $weekStart = $today->copy()->startOfWeek();
        $monthStart = $today->copy()->startOfMonth();

        $bookingsToday = 0;
        $bookingsWeek = 0;
        $bookingsMonth = 0;
        $bookingsTotal = 0;
        $pendingBookings = 0;
        $confirmedBookings = 0;
        $completedBookings = 0;
        $conversionRate = 0;
        $enquiriesToday = 0;
        $enquiriesWeek = 0;

        if (Schema::hasTable('bookings')) {
            $base = DB::table('bookings')->whereNull('deleted_at');

            $bookingsToday   = (clone $base)->whereDate('created_at', $today)->count();
            $bookingsWeek    = (clone $base)->where('created_at', '>=', $weekStart)->count();
            $bookingsMonth   = (clone $base)->where('created_at', '>=', $monthStart)->count();
            $bookingsTotal   = (clone $base)->count();
            $pendingBookings   = (clone $base)->where('status', 'pending')->count();
            $confirmedBookings = (clone $base)->where('status', 'confirmed')->count();
            $completedBookings = (clone $base)->where('status', 'completed')->count();

            $finished = $confirmedBookings + $completedBookings;
            $conversionRate = $bookingsTotal > 0
                ? round(($finished / max(1, $bookingsTotal)) * 100, 1)
                : 0;
        }

        if (Schema::hasTable('enquiries')) {
            $eBase = DB::table('enquiries')->whereNull('deleted_at');
            $enquiriesToday = (clone $eBase)->whereDate('created_at', $today)->count();
            $enquiriesWeek  = (clone $eBase)->where('created_at', '>=', $weekStart)->count();
        }

        return [
            'bookings_today'      => $bookingsToday,
            'bookings_week'       => $bookingsWeek,
            'bookings_month'      => $bookingsMonth,
            'bookings_total'      => $bookingsTotal,
            'pending_bookings'    => $pendingBookings,
            'confirmed_bookings'  => $confirmedBookings,
            'completed_bookings'  => $completedBookings,
            'conversion_rate'     => $conversionRate,
            'enquiries_today'     => $enquiriesToday,
            'enquiries_week'      => $enquiriesWeek,
        ];
    }

    /* =====================================================================
     * Recent activity feed (mixed bookings + enquiries, last 10)
     * ===================================================================== */

    private function recentActivity(): array
    {
        $items = [];

        if (Schema::hasTable('bookings')) {
            $bookings = DB::table('bookings')
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(['id', 'full_name', 'email', 'pickup', 'status', 'created_at']);

            foreach ($bookings as $b) {
                $items[] = [
                    'type'       => 'booking',
                    'id'         => $b->id,
                    'name'       => $b->full_name,
                    'detail'     => $b->pickup ?: $b->email,
                    'status'     => $b->status,
                    'created_at' => $b->created_at,
                    'url'        => route('admin.booking.edit', $b->id),
                ];
            }
        }

        if (Schema::hasTable('enquiries')) {
            $enquiries = DB::table('enquiries')
                ->whereNull('deleted_at')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(['id', 'name', 'email', 'subject', 'created_at']);

            foreach ($enquiries as $e) {
                $items[] = [
                    'type'       => 'enquiry',
                    'id'         => $e->id,
                    'name'       => $e->name,
                    'detail'     => $e->subject ?: $e->email,
                    'status'     => null,
                    'created_at' => $e->created_at,
                    'url'        => route('admin.enquiry.edit', $e->id),
                ];
            }
        }

        // Sort combined feed by created_at desc; keep top 10
        usort($items, function ($a, $b) {
            return strcmp((string) $b['created_at'], (string) $a['created_at']);
        });

        return array_slice($items, 0, 10);
    }

    /* =====================================================================
     * Last-30-days booking trend (for ChartJS)
     * ===================================================================== */

    private function bookingsLast30Days(): array
    {
        $labels = [];
        $values = [];

        if (!Schema::hasTable('bookings')) {
            return ['labels' => $labels, 'values' => $values];
        }

        $start = Carbon::today()->subDays(29);

        // Build a map of yyyy-mm-dd => count
        $rows = DB::table('bookings')
            ->whereNull('deleted_at')
            ->where('created_at', '>=', $start)
            ->selectRaw('DATE(created_at) AS d, COUNT(*) AS c')
            ->groupBy('d')
            ->pluck('c', 'd')
            ->toArray();

        for ($i = 0; $i < 30; $i++) {
            $day = $start->copy()->addDays($i);
            $key = $day->format('Y-m-d');
            $labels[] = $day->format('d.m.');
            $values[] = (int) ($rows[$key] ?? 0);
        }

        return ['labels' => $labels, 'values' => $values];
    }

    /* =====================================================================
     * Pending counts for sidebar badges
     * ===================================================================== */

    private function pendingCounts(): array
    {
        $b = 0; $e = 0;
        if (Schema::hasTable('bookings')) {
            $b = DB::table('bookings')
                ->whereNull('deleted_at')
                ->where('status', 'pending')
                ->count();
        }
        if (Schema::hasTable('enquiries')) {
            $e = DB::table('enquiries')
                ->whereNull('deleted_at')
                ->where(function ($q) {
                    if (Schema::hasColumn('enquiries', 'is_read')) {
                        $q->where('is_read', 0)->orWhereNull('is_read');
                    }
                })
                ->count();
        }
        return [
            'bookings'  => $b,
            'enquiries' => $e,
        ];
    }
}
