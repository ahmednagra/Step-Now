<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Policy pages — DSGVO / TMG / PBefG-compliant German legal texts.
 *
 * IMPORTANT — these are TEMPLATE texts tailored to StepNow Rides & Movers e.K.
 * They cover the baseline German legal requirements for a Mietwagen +
 * Paketdienst operation, but YOU are responsible for having a Rechtsanwalt
 * or Datenschutzbeauftragter review them before going live.
 *
 * Placeholders marked with [BITTE ERGÄNZEN] must be filled in once the
 * corresponding authority data is available:
 *   - USt-IdNr (once issued by Finanzamt)
 *   - PBefG-Konzessionsnummer (once issued by Landratsamt Esslingen)
 *
 * Legal basis for each page:
 *   - Impressum  → § 5 TMG + § 18 MStV
 *   - Datenschutz → Art. 13 DSGVO + § 25 TTDSG
 *   - AGB        → §§ 305–310 BGB (general T&C framework)
 *   - Cookies    → § 25 TTDSG + Art. 6(1) DSGVO
 *   - Widerruf   → § 312g BGB / EU VRRL
 */
class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            // ==========================================================
            // 1) IMPRESSUM
            // ==========================================================
            [
                'id'           => 1,
                'title'        => 'Impressum',
                'page_title'   => 'Impressum',
                'description'  => $this->impressum(),
                'meta_title'   => 'Impressum – StepNow Rides & Movers e.K.',
                'meta_keyword' => 'Impressum, StepNow Rides, Naeem Ahmad, Deizisau',
                'meta_description' => 'Impressum nach § 5 TMG für StepNow Rides & Movers e.K., Mietwagen- und Paketdienstunternehmen in Deizisau, Landkreis Esslingen.',
                'slug'         => 'impressum',
                'status'       => 'active',
                'created_at'   => '2026-04-24 12:00:00',
                'updated_at'   => now(),
            ],

            // ==========================================================
            // 2) DATENSCHUTZERKLÄRUNG
            // ==========================================================
            [
                'id'           => 2,
                'title'        => 'Datenschutzerklärung',
                'page_title'   => 'Datenschutzerklärung',
                'description'  => $this->datenschutz(),
                'meta_title'   => 'Datenschutzerklärung – StepNow Rides & Movers e.K.',
                'meta_keyword' => 'Datenschutz, DSGVO, StepNow Rides, Deizisau',
                'meta_description' => 'Informationen zur Verarbeitung personenbezogener Daten nach Art. 13 DSGVO bei StepNow Rides & Movers e.K.',
                'slug'         => 'datenschutz',
                'status'       => 'active',
                'created_at'   => '2026-04-24 12:00:00',
                'updated_at'   => now(),
            ],

            // ==========================================================
            // 3) AGB
            // ==========================================================
            [
                'id'           => 3,
                'title'        => 'Allgemeine Geschäftsbedingungen',
                'page_title'   => 'AGB',
                'description'  => $this->agb(),
                'meta_title'   => 'AGB – StepNow Rides & Movers e.K.',
                'meta_keyword' => 'AGB, Geschäftsbedingungen, Mietwagen, Paketdienst',
                'meta_description' => 'Allgemeine Geschäftsbedingungen für Mietwagen- und Paketdienstleistungen der StepNow Rides & Movers e.K.',
                'slug'         => 'agb',
                'status'       => 'active',
                'created_at'   => '2026-04-24 12:00:00',
                'updated_at'   => now(),
            ],

            // ==========================================================
            // 4) COOKIE-RICHTLINIE
            // ==========================================================
            [
                'id'           => 4,
                'title'        => 'Cookie-Richtlinie',
                'page_title'   => 'Cookie-Richtlinie',
                'description'  => $this->cookies(),
                'meta_title'   => 'Cookie-Richtlinie – StepNow Rides & Movers e.K.',
                'meta_keyword' => 'Cookies, TTDSG, Tracking',
                'meta_description' => 'Informationen über die Verwendung von Cookies auf step-now.de nach § 25 TTDSG.',
                'slug'         => 'cookies',
                'status'       => 'active',
                'created_at'   => '2026-04-24 12:00:00',
                'updated_at'   => now(),
            ],

            // ==========================================================
            // 5) WIDERRUFSBELEHRUNG
            // ==========================================================
            [
                'id'           => 5,
                'title'        => 'Widerrufsbelehrung',
                'page_title'   => 'Widerrufsbelehrung',
                'description'  => $this->widerruf(),
                'meta_title'   => 'Widerrufsbelehrung – StepNow Rides & Movers e.K.',
                'meta_keyword' => 'Widerruf, Verbraucherrechte, Stornierung',
                'meta_description' => 'Widerrufsbelehrung für Verbraucher nach § 312g BGB für Buchungen bei StepNow Rides & Movers e.K.',
                'slug'         => 'widerruf',
                'status'       => 'active',
                'created_at'   => '2026-04-24 12:00:00',
                'updated_at'   => now(),
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
<h2>Angaben gemäß § 5 TMG</h2>

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
Umsatzsteuer-ID nach § 27 a Umsatzsteuergesetz:<br>
<em>[BITTE ERGÄNZEN – wird nach Erteilung durch das Finanzamt nachgereicht]</em>
</p>

<h3>Aufsichtsbehörde / Konzession</h3>
<p>
Konzession für den Mietwagenverkehr nach § 2 Abs. 1 Nr. 4 PBefG:<br>
<em>[BITTE ERGÄNZEN – Antrag beim Landratsamt Esslingen in Bearbeitung]</em>
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

<h3>EU-Streitschlichtung</h3>
<p>
Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
<a href="https://ec.europa.eu/consumers/odr/" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr/</a><br>
Unsere E-Mail-Adresse finden Sie oben im Impressum.
</p>

<h3>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h3>
<p>
Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
</p>

<h3>Haftung für Inhalte</h3>
<p>
Als Diensteanbieter sind wir gemäß § 7 Abs. 1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich.
Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen
zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
</p>

<h3>Haftung für Links</h3>
<p>
Unser Angebot enthält ggf. Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir
für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter
oder Betreiber der Seiten verantwortlich.
</p>

<h3>Urheberrecht</h3>
<p>
Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die
Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der
schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
</p>
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
(insb. der ausführende Fahrer). Eine Übermittlung in Drittländer außerhalb der EU findet nicht statt.
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
Bestimmungen. Details finden sich in der <a href="/policy/datenschutz">Datenschutzerklärung</a>.
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
Cookies erfolgt gemäß § 25 Abs. 1 TTDSG und Art. 6 Abs. 1 lit. a DSGVO nur mit Ihrer Einwilligung.
</p>

<h3>1. Was sind Cookies?</h3>
<p>
Cookies sind kleine Textdateien, die beim Besuch einer Website auf Ihrem Gerät gespeichert werden. Sie
ermöglichen es, Ihren Browser bei einem erneuten Besuch wiederzuerkennen.
</p>

<h3>2. Welche Cookies verwenden wir?</h3>
<ul>
  <li>
    <strong>Technisch notwendige Cookies</strong> (Rechtsgrundlage: § 25 Abs. 2 Nr. 2 TTDSG):
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
Sie können Ihre Cookie-Einstellungen jederzeit anpassen oder widerrufen, indem Sie den Cookie-Banner neu
öffnen oder Cookies direkt in Ihrem Browser löschen. Ein Widerruf der Einwilligung berührt die
Rechtmäßigkeit der bis dahin erfolgten Verarbeitung nicht.
</p>

<h3>4. Speicherdauer</h3>
<p>
Session-Cookies werden mit Beendigung Ihrer Browsersitzung automatisch gelöscht. Persistente Cookies
haben eine Lebensdauer von maximal 12 Monaten, sofern nichts anderes angegeben ist.
</p>
HTML;
    }

    private function widerruf(): string
    {
        return <<<'HTML'
<h2>Widerrufsbelehrung für Verbraucher</h2>

<p>
Verbrauchern steht nach § 312g BGB ein Widerrufsrecht bei außerhalb von Geschäftsräumen geschlossenen Verträgen
und bei Fernabsatzverträgen grundsätzlich zu.
</p>

<h3>Ausnahme für Personenbeförderung</h3>
<p>
<strong>Hinweis:</strong> Nach § 312 Abs. 2 Nr. 5 BGB besteht <strong>kein Widerrufsrecht</strong> bei Verträgen zur
Erbringung von Dienstleistungen im Zusammenhang mit <strong>Personenbeförderung</strong> zu einem bestimmten Termin
oder in einem bestimmten Zeitraum. Für Mietwagenfahrten mit festem Termin gilt daher ausschließlich unsere
Stornoregelung nach § 5 der <a href="/policy/agb">AGB</a>.
</p>

<h3>Widerrufsrecht für Paketdienstleistungen</h3>
<p>
Für Paketdienstleistungen, die nicht zu einem bestimmten Termin erbracht werden müssen, gilt das gesetzliche
Widerrufsrecht. Sie haben das Recht, binnen 14 Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen.
</p>

<h4>Folgen des Widerrufs</h4>
<p>
Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, unverzüglich
und spätestens binnen 14 Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses
Vertrages bei uns eingegangen ist. Haben Sie verlangt, dass die Dienstleistung während der Widerrufsfrist beginnen
soll, schulden Sie uns einen angemessenen Betrag für die bis zum Widerruf bereits erbrachte Leistung.
</p>

<h3>Widerruf per E-Mail</h3>
<p>
Um Ihr Widerrufsrecht auszuüben, genügt eine eindeutige Erklärung per E-Mail an
<a href="mailto:info@step-now.de">info@step-now.de</a> oder per Brief an die im Impressum genannte Adresse.
</p>

<h3>Muster-Widerrufsformular</h3>
<p>
Sie können das folgende Muster-Formular verwenden (nicht verpflichtend):
</p>
<pre style="white-space: pre-wrap; font-family: monospace; background: #f7f7f7; padding: 1em; border-radius: 4px;">
An: StepNow Rides &amp; Movers e.K., Blumenstraße 8, 73779 Deizisau
E-Mail: info@step-now.de

Hiermit widerrufe(n) ich/wir (*) den von mir/uns (*) abgeschlossenen Vertrag
über die Erbringung der folgenden Dienstleistung:

________________________________________________________________
Bestellt am / erhalten am:
________________________________________________________________
Name des/der Verbraucher(s):
________________________________________________________________
Anschrift des/der Verbraucher(s):
________________________________________________________________
Datum, Unterschrift (nur bei Mitteilung auf Papier)
________________________________________________________________

(*) Unzutreffendes streichen.
</pre>
HTML;
    }
}
