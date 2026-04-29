<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Policy pages — DSGVO / DDG / TDDDG / PBefG-compliant German legal texts.
 *
 * Schema matches migration 2025_11_12_000009_create_policies_table:
 *   id, title, page_title (nullable), description (nullable text),
 *   order_no (default 0), status (active/inactive), timestamps.
 *
 * Single source of truth: this seeder writes the rows and the front-end
 * controller (App\Http\Controllers\Front\PolicyController) reads them
 * back by `title`. To update wording in production:
 *
 *   php artisan db:seed --class=Database\\Seeders\\PolicySeeder --force
 *
 * Legal basis per page (CURRENT, post-14.05.2024 DDG/TDDDG transition):
 *   - Impressum   → § 5 DDG + § 18 MStV
 *   - Datenschutz → Art. 13/14 DSGVO + § 25 TDDDG
 *   - AGB         → §§ 305–310 BGB
 *   - Cookies     → § 25 TDDDG + Art. 6(1) DSGVO
 *   - Widerruf    → § 312g BGB / EU VRRL
 *
 * Notes on legal updates baked in:
 *   - TMG references replaced with DDG (in force since 14.05.2024).
 *   - TTDSG references replaced with TDDDG (renamed 14.05.2024).
 *   - EU OS-Plattform reference REMOVED (mandatory since 20.07.2025).
 *   - Cloudflare disclosure added in Datenschutz §4a (Drittland-Übermittlung
 *     into the USA must be named, EU-US Data Privacy Framework cited).
 *   - Phone number is the one on the Gewerbeanmeldung GewA 1 (28.10.2025).
 *
 * Open items (to be filled in via the admin UI once available):
 *   - USt-IdNr (after Finanzamt issues it)
 *   - PBefG-Konzessionsnummer (after Landratsamt Esslingen issues it)
 *
 * IMPORTANT: this file is the canonical source. Do not edit the rendered
 * pages in any other place (e.g. database directly, or Blade templates) —
 * always update here and re-seed.
 */
class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            [
                'id'          => 1,
                'title'       => 'Impressum',
                'page_title'  => 'Impressum',
                'description' => $this->impressum(),
                'order_no'    => 1,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 2,
                'title'       => 'Datenschutzerklärung',
                'page_title'  => 'Datenschutzerklärung',
                'description' => $this->datenschutz(),
                'order_no'    => 2,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 3,
                'title'       => 'Allgemeine Geschäftsbedingungen',
                'page_title'  => 'AGB',
                'description' => $this->agb(),
                'order_no'    => 3,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 4,
                'title'       => 'Cookie-Richtlinie',
                'page_title'  => 'Cookie-Richtlinie',
                'description' => $this->cookies(),
                'order_no'    => 4,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
            [
                'id'          => 5,
                'title'       => 'Widerrufsbelehrung',
                'page_title'  => 'Widerrufsbelehrung',
                'description' => $this->widerruf(),
                'order_no'    => 5,
                'status'      => 'active',
                'created_at'  => '2026-04-24 12:00:00',
                'updated_at'  => now(),
            ],
        ];

        foreach ($policies as $row) {
            DB::table('policies')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    /* ==========================================================
     *  LEGAL TEXT BODIES
     * ==========================================================*/

    private function impressum(): string
    {
        return <<<'HTML'
<h2>Angaben gemäß § 5 DDG</h2>

<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Inhaber: Naeem Ahmad<br>
Blumenstraße 8<br>
73779 Deizisau<br>
Deutschland
</p>

<h3>Kontakt</h3>
<p>
Telefon: +49 159 01228856<br>
E-Mail: info@step-now.de<br>
Internet: https://step-now.de
</p>

<h3>Handelsregister</h3>
<p>
Registergericht: Amtsgericht Stuttgart<br>
Registernummer: HRA 742905
</p>

<h3>Umsatzsteuer-Identifikationsnummer</h3>
<p>
Eine Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz wird derzeit nicht geführt.
Sobald uns eine USt-IdNr. durch das zuständige Finanzamt erteilt wurde, wird diese hier ergänzt.
</p>

<h3>Aufsichtsbehörde / Konzession</h3>
<p>
Konzession für den Mietwagenverkehr nach § 2 Abs. 1 Nr. 4 PBefG:
Antrag beim Landratsamt Esslingen befindet sich in Bearbeitung. Bis zur Erteilung der Konzession
werden keine entgeltlichen Personenbeförderungsfahrten durchgeführt.
</p>

<p>
Zuständige Aufsichts- und Genehmigungsbehörde:<br>
Landratsamt Esslingen<br>
Pulverwiesen 11<br>
73726 Esslingen am Neckar<br>
Deutschland
</p>

<h3>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h3>
<p>
Naeem Ahmad<br>
Anschrift wie oben
</p>

<h3>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h3>
<p>
Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
</p>

<h3>Haftung für Inhalte</h3>
<p>
Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich.
Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen
zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung
oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche
Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von
entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
</p>

<h3>Haftung für Links</h3>
<p>
Unser Angebot enthält ggf. Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir
für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter
oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße
überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle
der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von
Rechtsverletzungen werden wir derartige Links umgehend entfernen.
</p>

<h3>Urheberrecht</h3>
<p>
Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die
Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der
schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten,
nicht kommerziellen Gebrauch gestattet.
</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function datenschutz(): string
    {
        return <<<'HTML'
<h2>Datenschutzerklärung</h2>

<p>
Wir freuen uns über Ihr Interesse an unserem Unternehmen. Datenschutz hat einen besonders hohen Stellenwert für die
Geschäftsleitung der StepNow Rides &amp; Movers e.K. Eine Nutzung unserer Internetseiten ist grundsätzlich ohne Angabe
personenbezogener Daten möglich. Sofern Sie jedoch besondere Services unseres Unternehmens in Anspruch nehmen möchten,
könnte eine Verarbeitung personenbezogener Daten erforderlich werden. Diese erfolgt stets im Einklang mit der
Datenschutz-Grundverordnung (DSGVO) und dem Bundesdatenschutzgesetz (BDSG).
</p>

<h3>1. Verantwortlicher für die Datenverarbeitung</h3>
<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Inhaber: Naeem Ahmad<br>
Blumenstraße 8, 73779 Deizisau<br>
Telefon: +49 159 01228856<br>
E-Mail: info@step-now.de
</p>

<h3>2. Welche Daten erheben wir?</h3>
<p>Bei Buchung einer Fahrt oder eines Paketdienstes verarbeiten wir die folgenden Kategorien personenbezogener Daten:</p>
<ul>
  <li>Kontaktdaten: Name, Telefonnummer, E-Mail-Adresse</li>
  <li>Fahrtdaten: Abhol- und Zieladresse, Datum, Uhrzeit, Anzahl der Fahrgäste, ggf. Flug-/Zugnummer</li>
  <li>Paketdaten: Gewicht, Abmessungen, Inhalt (allgemein), Empfängerkontakt</li>
  <li>Zahlungsdaten (nur soweit zur Abwicklung erforderlich)</li>
  <li>Technische Daten beim Besuch der Website: IP-Adresse, Browser, Referrer-URL, Zugriffszeitpunkt</li>
</ul>
<p>
Konkret werden bei Nutzung des Buchungs- bzw. Kontaktformulars folgende Pflichtangaben verarbeitet: Name, E-Mail,
Telefonnummer, Abhol- und Zieladresse sowie Datum/Uhrzeit. Rechtsgrundlage ist die Vertragsanbahnung bzw. -durchführung
gemäß Art. 6 Abs. 1 lit. b DSGVO.
</p>

<h3>3. Zwecke und Rechtsgrundlage der Verarbeitung</h3>
<ul>
  <li><strong>Vertragserfüllung (Art. 6 Abs. 1 lit. b DSGVO):</strong> Durchführung der Beförderungs- oder Lieferleistung.</li>
  <li><strong>Rechtliche Verpflichtungen (Art. 6 Abs. 1 lit. c DSGVO):</strong> Aufbewahrung von Rechnungen gemäß § 147 AO (10 Jahre).</li>
  <li><strong>Berechtigte Interessen (Art. 6 Abs. 1 lit. f DSGVO):</strong> Sichere Bereitstellung der Website, Betrugsprävention.</li>
  <li><strong>Einwilligung (Art. 6 Abs. 1 lit. a DSGVO):</strong> Newsletter, nicht essenzielle Cookies.</li>
</ul>

<h3>4. Empfänger der Daten</h3>
<p>
Ihre Daten werden ausschließlich an Personen oder Stellen weitergegeben, die zur Durchführung der Leistung erforderlich sind
(insb. der ausführende Fahrer). Eine Übermittlung in Drittländer außerhalb der EU findet ausschließlich im Rahmen der unter
Punkt 4a beschriebenen technischen Bereitstellung der Website statt.
</p>

<h3>4a. Content Delivery Network (Cloudflare)</h3>
<p>
Zur sicheren und performanten Auslieferung dieser Webseite setzen wir den Dienst Cloudflare
(Cloudflare Inc., 101 Townsend St, San Francisco, CA 94107, USA) ein. Cloudflare verarbeitet hierbei
insbesondere IP-Adressen, Browser-Informationen und HTTP-Header. Rechtsgrundlage ist Art. 6 Abs. 1
lit. f DSGVO (berechtigtes Interesse an einer sicheren und schnellen Bereitstellung des Webangebots
sowie an der Abwehr von DDoS-Angriffen). Cloudflare ist nach dem EU-US Data Privacy Framework
zertifiziert; ergänzend bestehen Standardvertragsklauseln nach Art. 46 Abs. 2 lit. c DSGVO.
</p>

<h3>5. Speicherdauer</h3>
<p>
Wir speichern personenbezogene Daten nur so lange, wie dies für die Erfüllung des Zwecks erforderlich ist bzw. gesetzliche
Aufbewahrungsfristen dies vorschreiben (insb. 10 Jahre für steuerlich relevante Unterlagen nach § 147 AO).
</p>

<h3>6. Ihre Rechte als betroffene Person</h3>
<p>Sie haben jederzeit folgende Rechte:</p>
<ul>
  <li>Auskunft über Ihre gespeicherten Daten (Art. 15 DSGVO)</li>
  <li>Berichtigung unrichtiger Daten (Art. 16 DSGVO)</li>
  <li>Löschung (Art. 17 DSGVO)</li>
  <li>Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
  <li>Datenübertragbarkeit (Art. 20 DSGVO)</li>
  <li>Widerspruch gegen die Verarbeitung (Art. 21 DSGVO)</li>
  <li>Widerruf erteilter Einwilligungen (Art. 7 Abs. 3 DSGVO)</li>
</ul>

<h3>7. Beschwerderecht bei der Aufsichtsbehörde</h3>
<p>
Sie haben das Recht, sich bei einer Datenschutz-Aufsichtsbehörde zu beschweren. Zuständig ist für uns:<br>
<strong>Der Landesbeauftragte für den Datenschutz und die Informationsfreiheit Baden-Württemberg</strong><br>
Lautenschlagerstraße 20, 70173 Stuttgart<br>
Telefon: +49 711 615541-0 · E-Mail: poststelle@lfdi.bwl.de
</p>

<h3>8. Kontaktaufnahme</h3>
<p>
Für alle Anfragen zum Datenschutz erreichen Sie uns unter: <strong>info@step-now.de</strong>.
</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function agb(): string
    {
        return <<<'HTML'
<h2>Allgemeine Geschäftsbedingungen (AGB)</h2>

<h3>§ 1 Geltungsbereich</h3>
<p>
Diese Allgemeinen Geschäftsbedingungen gelten für alle Verträge über die Durchführung von Personenbeförderungs-
und Paketdienstleistungen zwischen der StepNow Rides &amp; Movers e.K. (nachfolgend "Anbieter") und ihren
Kunden (nachfolgend "Kunde").
</p>

<h3>§ 2 Vertragsgegenstand</h3>
<p>
Der Anbieter erbringt Beförderungsleistungen im Mietwagenverkehr nach § 49 PBefG sowie Paketzustellungen
innerhalb Deutschlands. Eine verbindliche Buchung kommt mit der Bestätigung durch den Anbieter zustande.
</p>

<h3>§ 3 Buchung und Vertragsschluss</h3>
<p>
Buchungen können telefonisch, per E-Mail oder über die Website step-now.de erfolgen. Der Anbieter bestätigt
jede Buchung schriftlich (per E-Mail oder Messenger). Ohne Bestätigung kommt kein Vertrag zustande.
</p>

<h3>§ 4 Preise und Zahlung</h3>
<p>
Es gelten die zum Zeitpunkt der Buchung kommunizierten Festpreise inklusive der gesetzlichen Umsatzsteuer.
Zahlungen können in bar beim Fahrer, per Überweisung oder per in der Buchung angebotenem elektronischem
Zahlungsmittel geleistet werden.
</p>

<h3>§ 5 Stornierung durch den Kunden</h3>
<p>
Stornierungen sind bis 24 Stunden vor dem vereinbarten Abholzeitpunkt kostenfrei. Bei späterer Stornierung
berechnet der Anbieter eine Ausfallgebühr in Höhe von 50 % des Fahrpreises; bei Stornierung weniger als
2 Stunden vor Abholung 100 %.
</p>

<h3>§ 6 Pflichten des Kunden</h3>
<p>
Der Kunde ist verpflichtet, am vereinbarten Abholort rechtzeitig bereitzustehen. Bei Paketsendungen muss
der Kunde den Inhalt wahrheitsgemäß deklarieren. Gefahrgut, verbotene oder verderbliche Waren sind vom
Transport ausgeschlossen.
</p>

<h3>§ 7 Haftung</h3>
<p>
Der Anbieter haftet unbeschränkt für Vorsatz und grobe Fahrlässigkeit sowie nach dem Produkthaftungsgesetz.
Bei leichter Fahrlässigkeit haftet der Anbieter nur bei Verletzung einer wesentlichen Vertragspflicht und
begrenzt auf den vertragstypisch vorhersehbaren Schaden. Für Pakettransporte gelten ergänzend §§ 407 ff. HGB.
</p>

<h3>§ 8 Datenschutz</h3>
<p>
Der Anbieter verarbeitet personenbezogene Daten des Kunden ausschließlich im Rahmen der gesetzlichen
Bestimmungen. Details finden sich in der Datenschutzerklärung.
</p>

<h3>§ 9 Anwendbares Recht und Gerichtsstand</h3>
<p>
Es gilt das Recht der Bundesrepublik Deutschland. Ausschließlicher Gerichtsstand für alle Streitigkeiten
aus diesem Vertragsverhältnis mit Kaufleuten ist, soweit gesetzlich zulässig, Esslingen am Neckar.
</p>

<h3>§ 10 Salvatorische Klausel</h3>
<p>
Sollten einzelne Bestimmungen dieser AGB unwirksam sein, berührt dies die Wirksamkeit der übrigen
Bestimmungen nicht.
</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function cookies(): string
    {
        return <<<'HTML'
<h2>Cookie-Richtlinie</h2>

<p>
Diese Website verwendet Cookies und vergleichbare Technologien. Die Nutzung nicht technisch notwendiger
Cookies erfolgt gemäß § 25 Abs. 1 TDDDG und Art. 6 Abs. 1 lit. a DSGVO nur mit Ihrer Einwilligung.
</p>

<h3>1. Was sind Cookies?</h3>
<p>
Cookies sind kleine Textdateien, die beim Besuch einer Website auf Ihrem Gerät gespeichert werden. Sie
ermöglichen es, Ihren Browser bei einem erneuten Besuch wiederzuerkennen.
</p>

<h3>2. Welche Cookies verwenden wir?</h3>
<ul>
  <li>
    <strong>Technisch notwendige Cookies</strong> (Rechtsgrundlage: § 25 Abs. 2 Nr. 2 TDDDG):
    erforderlich für den Betrieb der Website (z. B. Session-Cookie, CSRF-Schutz, Cookie-Einwilligung).
  </li>
  <li>
    <strong>Funktionale Cookies</strong> (Rechtsgrundlage: Einwilligung):
    Sprache und Voreinstellungen des Nutzers.
  </li>
  <li>
    <strong>Analyse-/Marketing-Cookies</strong> (Rechtsgrundlage: Einwilligung):
    derzeit nicht im Einsatz; sollten diese aktiviert werden, wird hier eine detaillierte Liste ergänzt.
  </li>
</ul>

<h3>3. Einwilligung verwalten</h3>
<p>
Sie können Ihre Cookie-Einstellungen jederzeit anpassen oder widerrufen, indem Sie den Cookie-Banner über
den Link „Cookie-Einstellungen“ im Footer erneut öffnen oder Cookies direkt in Ihrem Browser löschen.
Ein Widerruf der Einwilligung berührt die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung nicht.
</p>

<h3>4. Speicherdauer</h3>
<p>
Session-Cookies werden mit Beendigung Ihrer Browsersitzung automatisch gelöscht. Persistente Cookies
haben eine Lebensdauer von maximal 12 Monaten, sofern nichts anderes angegeben ist. Die Einwilligung
selbst wird gemäß DSK-Empfehlung 13 Monate gespeichert.
</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function widerruf(): string
    {
        return <<<'HTML'
<h2>Widerrufsbelehrung für Verbraucher</h2>

<p>
Verbrauchern steht nach § 312g BGB ein Widerrufsrecht bei außerhalb von Geschäftsräumen geschlossenen Verträgen
und bei Fernabsatzverträgen grundsätzlich zu. Verbraucher ist jede natürliche Person, die ein Rechtsgeschäft zu
Zwecken abschließt, die überwiegend weder ihrer gewerblichen noch ihrer selbständigen beruflichen Tätigkeit
zugerechnet werden können.
</p>

<h3>Widerrufsrecht</h3>
<p>
Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die
Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.
</p>

<p>
Um Ihr Widerrufsrecht auszuüben, müssen Sie uns
</p>
<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Blumenstraße 8, 73779 Deizisau<br>
Telefon: +49 159 01228856<br>
E-Mail: info@step-now.de
</p>
<p>
mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief oder E-Mail) über Ihren
Entschluss, diesen Vertrag zu widerrufen, informieren.
</p>

<h3>Folgen des Widerrufs</h3>
<p>
Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben,
unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über
Ihren Widerruf dieses Vertrags bei uns eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe
Zahlungsmittel, das Sie bei der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen
wurde ausdrücklich etwas anderes vereinbart.
</p>

<h3>Erlöschen des Widerrufsrechts bei Beförderungsverträgen</h3>
<p>
Das Widerrufsrecht besteht nach § 312g Abs. 2 Nr. 9 BGB nicht bei Verträgen zur Erbringung von
Dienstleistungen im Zusammenhang mit Beförderung von Personen, wenn der Vertrag für die Erbringung
einen spezifischen Termin oder Zeitraum vorsieht.
</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }
}
