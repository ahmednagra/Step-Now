<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Partners — starts empty.
 *
 * The previous seeder held 9 junk placeholder rows (titles like "Abc",
 * "1w2", "adsa") which must not appear on a public German business
 * website. Partners should be added via the admin UI once real
 * relationships exist (e.g. hotels, Flughafen Stuttgart, event venues).
 *
 * This seeder truncates the table on each run to clear any stale
 * placeholder data left over from earlier imports.
 */
class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        // Remove any legacy placeholder rows.
        // (Soft-delete-safe: partners table does not use SoftDeletes.)
        DB::table('partners')->delete();
    }
}
