<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Bilingual policy pages — German is the LEGAL source of truth,
 * English is a courtesy translation.
 *
 * Schema (after migrations 2025_11_12_000009 + 2026_04_29_000002):
 *   id, title, page_title, page_title_en, description, description_en,
 *   order_no, status, timestamps.
 *
 * Reading rule (PolicyController):
 *   if (locale === 'en' && description_en non-empty) → serve EN
 *   else                                              → serve DE
 *
 * Important: Each English version starts with a small notice that the
 * German version is legally authoritative, in case of conflict. This is
 * standard practice for a German company providing English copies.
 *
 * Re-seed command (idempotent — uses updateOrInsert by id):
 *   php artisan db:seed --class=Database\\Seeders\\PolicySeeder --force
 */
class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            [
                'id'             => 1,
                'title'          => 'Impressum',
                'page_title'     => 'Impressum',
                'page_title_en'  => 'Imprint',
                'description'    => $this->impressum(),
                'description_en' => $this->impressumEn(),
                'order_no'       => 1,
                'status'         => 'active',
                'created_at'     => '2026-04-24 12:00:00',
                'updated_at'     => now(),
            ],
            [
                'id'             => 2,
                'title'          => 'Datenschutzerklärung',
                'page_title'     => 'Datenschutzerklärung',
                'page_title_en'  => 'Privacy Policy',
                'description'    => $this->datenschutz(),
                'description_en' => $this->datenschutzEn(),
                'order_no'       => 2,
                'status'         => 'active',
                'created_at'     => '2026-04-24 12:00:00',
                'updated_at'     => now(),
            ],
            [
                'id'             => 3,
                'title'          => 'Allgemeine Geschäftsbedingungen',
                'page_title'     => 'AGB',
                'page_title_en'  => 'Terms & Conditions',
                'description'    => $this->agb(),
                'description_en' => $this->agbEn(),
                'order_no'       => 3,
                'status'         => 'active',
                'created_at'     => '2026-04-24 12:00:00',
                'updated_at'     => now(),
            ],
            [
                'id'             => 4,
                'title'          => 'Cookie-Richtlinie',
                'page_title'     => 'Cookie-Richtlinie',
                'page_title_en'  => 'Cookie Policy',
                'description'    => $this->cookies(),
                'description_en' => $this->cookiesEn(),
                'order_no'       => 4,
                'status'         => 'active',
                'created_at'     => '2026-04-24 12:00:00',
                'updated_at'     => now(),
            ],
            [
                'id'             => 5,
                'title'          => 'Widerrufsbelehrung',
                'page_title'     => 'Widerrufsbelehrung',
                'page_title_en'  => 'Right of Withdrawal',
                'description'    => $this->widerruf(),
                'description_en' => $this->widerrufEn(),
                'order_no'       => 5,
                'status'         => 'active',
                'created_at'     => '2026-04-24 12:00:00',
                'updated_at'     => now(),
            ],
        ];

        foreach ($policies as $row) {
            DB::table('policies')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    /* ==========================================================
     *  GERMAN BODIES (legally authoritative)
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
<p>Diese Allgemeinen Geschäftsbedingungen gelten für alle Verträge über die Durchführung von Personenbeförderungs-
und Paketdienstleistungen zwischen der StepNow Rides &amp; Movers e.K. (nachfolgend "Anbieter") und ihren Kunden (nachfolgend "Kunde").</p>

<h3>§ 2 Vertragsgegenstand</h3>
<p>Der Anbieter erbringt Beförderungsleistungen im Mietwagenverkehr nach § 49 PBefG sowie Paketzustellungen
innerhalb Deutschlands. Eine verbindliche Buchung kommt mit der Bestätigung durch den Anbieter zustande.</p>

<h3>§ 3 Buchung und Vertragsschluss</h3>
<p>Buchungen können telefonisch, per E-Mail oder über die Website step-now.de erfolgen. Der Anbieter bestätigt
jede Buchung schriftlich (per E-Mail oder Messenger). Ohne Bestätigung kommt kein Vertrag zustande.</p>

<h3>§ 4 Preise und Zahlung</h3>
<p>Es gelten die zum Zeitpunkt der Buchung kommunizierten Festpreise inklusive der gesetzlichen Umsatzsteuer.
Zahlungen können in bar beim Fahrer, per Überweisung oder per in der Buchung angebotenem elektronischem
Zahlungsmittel geleistet werden.</p>

<h3>§ 5 Stornierung durch den Kunden</h3>
<p>Stornierungen sind bis 24 Stunden vor dem vereinbarten Abholzeitpunkt kostenfrei. Bei späterer Stornierung
berechnet der Anbieter eine Ausfallgebühr in Höhe von 50 % des Fahrpreises; bei Stornierung weniger als
2 Stunden vor Abholung 100 %.</p>

<h3>§ 6 Pflichten des Kunden</h3>
<p>Der Kunde ist verpflichtet, am vereinbarten Abholort rechtzeitig bereitzustehen. Bei Paketsendungen muss
der Kunde den Inhalt wahrheitsgemäß deklarieren. Gefahrgut, verbotene oder verderbliche Waren sind vom
Transport ausgeschlossen.</p>

<h3>§ 7 Haftung</h3>
<p>Der Anbieter haftet unbeschränkt für Vorsatz und grobe Fahrlässigkeit sowie nach dem Produkthaftungsgesetz.
Bei leichter Fahrlässigkeit haftet der Anbieter nur bei Verletzung einer wesentlichen Vertragspflicht und
begrenzt auf den vertragstypisch vorhersehbaren Schaden. Für Pakettransporte gelten ergänzend §§ 407 ff. HGB.</p>

<h3>§ 8 Datenschutz</h3>
<p>Der Anbieter verarbeitet personenbezogene Daten des Kunden ausschließlich im Rahmen der gesetzlichen
Bestimmungen. Details finden sich in der Datenschutzerklärung.</p>

<h3>§ 9 Anwendbares Recht und Gerichtsstand</h3>
<p>Es gilt das Recht der Bundesrepublik Deutschland. Ausschließlicher Gerichtsstand für alle Streitigkeiten
aus diesem Vertragsverhältnis mit Kaufleuten ist, soweit gesetzlich zulässig, Esslingen am Neckar.</p>

<h3>§ 10 Salvatorische Klausel</h3>
<p>Sollten einzelne Bestimmungen dieser AGB unwirksam sein, berührt dies die Wirksamkeit der übrigen
Bestimmungen nicht.</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function cookies(): string
    {
        return <<<'HTML'
<h2>Cookie-Richtlinie</h2>

<p>Diese Website verwendet Cookies und vergleichbare Technologien. Die Nutzung nicht technisch notwendiger
Cookies erfolgt gemäß § 25 Abs. 1 TDDDG und Art. 6 Abs. 1 lit. a DSGVO nur mit Ihrer Einwilligung.</p>

<h3>1. Was sind Cookies?</h3>
<p>Cookies sind kleine Textdateien, die beim Besuch einer Website auf Ihrem Gerät gespeichert werden. Sie
ermöglichen es, Ihren Browser bei einem erneuten Besuch wiederzuerkennen.</p>

<h3>2. Welche Cookies verwenden wir?</h3>
<ul>
  <li><strong>Technisch notwendige Cookies</strong> (Rechtsgrundlage: § 25 Abs. 2 Nr. 2 TDDDG):
    erforderlich für den Betrieb der Website (z. B. Session-Cookie, CSRF-Schutz, Cookie-Einwilligung).</li>
  <li><strong>Funktionale Cookies</strong> (Rechtsgrundlage: Einwilligung):
    Sprache und Voreinstellungen des Nutzers.</li>
  <li><strong>Analyse-/Marketing-Cookies</strong> (Rechtsgrundlage: Einwilligung):
    derzeit nicht im Einsatz; sollten diese aktiviert werden, wird hier eine detaillierte Liste ergänzt.</li>
</ul>

<h3>3. Einwilligung verwalten</h3>
<p>Sie können Ihre Cookie-Einstellungen jederzeit anpassen oder widerrufen, indem Sie den Cookie-Banner über
den Link „Cookie-Einstellungen" im Footer erneut öffnen oder Cookies direkt in Ihrem Browser löschen.
Ein Widerruf der Einwilligung berührt die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung nicht.</p>

<h3>4. Speicherdauer</h3>
<p>Session-Cookies werden mit Beendigung Ihrer Browsersitzung automatisch gelöscht. Persistente Cookies
haben eine Lebensdauer von maximal 12 Monaten, sofern nichts anderes angegeben ist. Die Einwilligung
selbst wird gemäß DSK-Empfehlung 13 Monate gespeichert.</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    private function widerruf(): string
    {
        return <<<'HTML'
<h2>Widerrufsbelehrung für Verbraucher</h2>

<p>Verbrauchern steht nach § 312g BGB ein Widerrufsrecht bei außerhalb von Geschäftsräumen geschlossenen Verträgen
und bei Fernabsatzverträgen grundsätzlich zu. Verbraucher ist jede natürliche Person, die ein Rechtsgeschäft zu
Zwecken abschließt, die überwiegend weder ihrer gewerblichen noch ihrer selbständigen beruflichen Tätigkeit
zugerechnet werden können.</p>

<h3>Widerrufsrecht</h3>
<p>Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die
Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.</p>

<p>Um Ihr Widerrufsrecht auszuüben, müssen Sie uns</p>
<p><strong>StepNow Rides &amp; Movers e.K.</strong><br>
Blumenstraße 8, 73779 Deizisau<br>
Telefon: +49 159 01228856<br>
E-Mail: info@step-now.de</p>
<p>mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief oder E-Mail) über Ihren
Entschluss, diesen Vertrag zu widerrufen, informieren.</p>

<h3>Folgen des Widerrufs</h3>
<p>Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben,
unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über
Ihren Widerruf dieses Vertrags bei uns eingegangen ist. Für diese Rückzahlung verwenden wir dasselbe
Zahlungsmittel, das Sie bei der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen
wurde ausdrücklich etwas anderes vereinbart.</p>

<h3>Erlöschen des Widerrufsrechts bei Beförderungsverträgen</h3>
<p>Das Widerrufsrecht besteht nach § 312g Abs. 2 Nr. 9 BGB nicht bei Verträgen zur Erbringung von
Dienstleistungen im Zusammenhang mit Beförderung von Personen, wenn der Vertrag für die Erbringung
einen spezifischen Termin oder Zeitraum vorsieht.</p>

<p><em>Stand: April 2026</em></p>
HTML;
    }

    /* ==========================================================
     *  ENGLISH BODIES (courtesy translation)
     * ==========================================================*/

    private function impressumEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> This is a courtesy translation of the German imprint.
The German version is legally authoritative.
<a href="?lang=de">View German version</a>
</p>

<h2>Information pursuant to § 5 DDG (German Digital Services Act)</h2>

<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Owner: Naeem Ahmad<br>
Blumenstraße 8<br>
73779 Deizisau<br>
Germany
</p>

<h3>Contact</h3>
<p>
Phone: +49 159 01228856<br>
Email: info@step-now.de<br>
Web: https://step-now.de
</p>

<h3>Commercial Register</h3>
<p>
Register Court: Local Court of Stuttgart (Amtsgericht Stuttgart)<br>
Registration Number: HRA 742905
</p>

<h3>VAT Identification Number</h3>
<p>
A VAT identification number under § 27a of the German VAT Act is currently not registered.
Once issued by the competent tax office, it will be added here.
</p>

<h3>Regulatory Authority / License</h3>
<p>
License for hire-car transport under § 2 (1) no. 4 PBefG (German Passenger Transport Act):
the application with the District Office of Esslingen is currently in progress. No paid passenger
transport services are being performed until the license is granted.
</p>

<p>
Competent supervisory and licensing authority:<br>
Landratsamt Esslingen<br>
Pulverwiesen 11<br>
73726 Esslingen am Neckar<br>
Germany
</p>

<h3>Responsible for content under § 18 (2) MStV</h3>
<p>
Naeem Ahmad<br>
Address as above
</p>

<h3>Consumer Dispute Resolution</h3>
<p>
We are neither willing nor obliged to participate in dispute resolution proceedings before a consumer arbitration board.
</p>

<h3>Liability for Content</h3>
<p>
As a service provider we are responsible under § 7 (1) DDG for our own content on these pages in accordance with general law.
However, under §§ 8 to 10 DDG we are not obliged as a service provider to monitor transmitted or stored third-party
information or to investigate circumstances that indicate unlawful activity. Obligations to remove or block the use of
information under general law remain unaffected. Liability in this regard, however, is only possible from the point in time
at which a specific infringement of the law becomes known. We will remove such content immediately upon becoming aware of any infringement.
</p>

<h3>Liability for Links</h3>
<p>
Our website may contain links to external third-party websites whose content we have no influence over. Therefore we cannot
assume any liability for these external contents. The respective provider or operator of the linked pages is always responsible
for their content. The linked pages were checked for possible legal violations at the time of linking. No illegal content was
identifiable at the time of linking. However, permanent monitoring of linked pages without specific evidence of an infringement
is not reasonable. Upon becoming aware of any infringement, we will remove such links immediately.
</p>

<h3>Copyright</h3>
<p>
The content and works on these pages created by the site operators are subject to German copyright law. Reproduction,
processing, distribution and any kind of exploitation outside the limits of copyright law require the written consent of the
respective author or creator. Downloads and copies of this site are only permitted for private, non-commercial use.
</p>

<p><em>Last updated: April 2026</em></p>
HTML;
    }

    private function datenschutzEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> This is a courtesy translation of the German privacy notice.
The German version is legally authoritative.
<a href="?lang=de">View German version</a>
</p>

<h2>Privacy Policy</h2>

<p>
We appreciate your interest in our company. The protection of personal data is of particular importance to the management
of StepNow Rides &amp; Movers e.K. Use of our website is generally possible without disclosing personal data. However, if
you wish to use specific services, processing of personal data may become necessary. Such processing always takes place in
accordance with the General Data Protection Regulation (GDPR) and the German Federal Data Protection Act (BDSG).
</p>

<h3>1. Data Controller</h3>
<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Owner: Naeem Ahmad<br>
Blumenstraße 8, 73779 Deizisau, Germany<br>
Phone: +49 159 01228856<br>
Email: info@step-now.de
</p>

<h3>2. What data do we collect?</h3>
<p>When you book a ride or a parcel service we process the following categories of personal data:</p>
<ul>
  <li>Contact data: name, phone number, email address</li>
  <li>Trip data: pickup and destination address, date, time, number of passengers, flight/train number where relevant</li>
  <li>Parcel data: weight, dimensions, contents (general), recipient contact</li>
  <li>Payment data (only as required for processing)</li>
  <li>Technical data when visiting the website: IP address, browser, referrer URL, time of access</li>
</ul>
<p>
When using the booking or contact form, the following mandatory data is processed: name, email, phone number,
pickup and destination address, and date/time. Legal basis is the initiation and performance of a contract under
Art. 6 (1) lit. b GDPR.
</p>

<h3>3. Purposes and legal basis of processing</h3>
<ul>
  <li><strong>Contract performance (Art. 6 (1) lit. b GDPR):</strong> performing the transport or delivery service.</li>
  <li><strong>Legal obligations (Art. 6 (1) lit. c GDPR):</strong> retention of invoices under § 147 AO (10 years).</li>
  <li><strong>Legitimate interests (Art. 6 (1) lit. f GDPR):</strong> secure operation of the website, fraud prevention.</li>
  <li><strong>Consent (Art. 6 (1) lit. a GDPR):</strong> newsletter, non-essential cookies.</li>
</ul>

<h3>4. Recipients of the data</h3>
<p>
Your data is only shared with persons or bodies necessary for performing the service (in particular the assigned driver).
Transfer to third countries outside the EU only takes place within the technical provision of the website described under section 4a.
</p>

<h3>4a. Content Delivery Network (Cloudflare)</h3>
<p>
For secure and performant delivery of this website we use Cloudflare (Cloudflare Inc., 101 Townsend St, San Francisco,
CA 94107, USA). Cloudflare processes IP addresses, browser information, and HTTP headers. Legal basis is Art. 6 (1) lit. f
GDPR (legitimate interest in the secure and fast delivery of the website and in the defence against DDoS attacks).
Cloudflare is certified under the EU-US Data Privacy Framework; Standard Contractual Clauses under Art. 46 (2) lit. c
GDPR additionally apply.
</p>

<h3>5. Storage period</h3>
<p>
We store personal data only for as long as is necessary for the purpose or as required by statutory retention periods
(in particular 10 years for tax-relevant documents under § 147 AO).
</p>

<h3>6. Your rights as a data subject</h3>
<p>You have the following rights at any time:</p>
<ul>
  <li>Access to your stored data (Art. 15 GDPR)</li>
  <li>Rectification of inaccurate data (Art. 16 GDPR)</li>
  <li>Erasure (Art. 17 GDPR)</li>
  <li>Restriction of processing (Art. 18 GDPR)</li>
  <li>Data portability (Art. 20 GDPR)</li>
  <li>Objection to processing (Art. 21 GDPR)</li>
  <li>Withdrawal of consent (Art. 7 (3) GDPR)</li>
</ul>

<h3>7. Right to lodge a complaint with a supervisory authority</h3>
<p>
You have the right to lodge a complaint with a data protection supervisory authority. The competent authority for us is:<br>
<strong>The State Commissioner for Data Protection and Freedom of Information of Baden-Württemberg</strong><br>
Lautenschlagerstraße 20, 70173 Stuttgart, Germany<br>
Phone: +49 711 615541-0 · Email: poststelle@lfdi.bwl.de
</p>

<h3>8. Contact</h3>
<p>For all data protection enquiries please reach us at: <strong>info@step-now.de</strong>.</p>

<p><em>Last updated: April 2026</em></p>
HTML;
    }

    private function agbEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> This is a courtesy translation of the German Terms &amp; Conditions.
The German version is legally authoritative in case of conflict.
<a href="?lang=de">View German version</a>
</p>

<h2>General Terms and Conditions (T&amp;C)</h2>

<h3>§ 1 Scope</h3>
<p>These General Terms and Conditions apply to all contracts for passenger transport and parcel delivery services
between StepNow Rides &amp; Movers e.K. (hereinafter "Provider") and its customers (hereinafter "Customer").</p>

<h3>§ 2 Subject of the Contract</h3>
<p>The Provider performs hire-car transport services under § 49 PBefG and parcel deliveries within Germany.
A binding booking is created upon confirmation by the Provider.</p>

<h3>§ 3 Booking and Conclusion of Contract</h3>
<p>Bookings can be made by phone, email, or via step-now.de. The Provider confirms each booking in writing
(by email or messenger). No contract is concluded without confirmation.</p>

<h3>§ 4 Prices and Payment</h3>
<p>Fixed prices communicated at the time of booking apply, including statutory VAT. Payment can be made in cash
to the driver, by bank transfer, or via the electronic payment method offered during booking.</p>

<h3>§ 5 Cancellation by the Customer</h3>
<p>Cancellations are free of charge up to 24 hours before the agreed pickup time. For later cancellations the
Provider charges a cancellation fee of 50 % of the fare; for cancellations less than 2 hours before pickup, 100 %.</p>

<h3>§ 6 Customer Obligations</h3>
<p>The Customer must be at the agreed pickup location on time. For parcel shipments the Customer must declare
the contents truthfully. Dangerous goods, prohibited or perishable items are excluded from transport.</p>

<h3>§ 7 Liability</h3>
<p>The Provider is liable without limitation for intent and gross negligence and under the German Product Liability Act.
For slight negligence, the Provider is liable only for breach of an essential contractual obligation, and limited to the
foreseeable damage typical for the contract. For parcel transport, §§ 407 ff. HGB additionally apply.</p>

<h3>§ 8 Data Protection</h3>
<p>The Provider processes the Customer's personal data exclusively within the framework of statutory provisions.
Details can be found in the Privacy Policy.</p>

<h3>§ 9 Applicable Law and Jurisdiction</h3>
<p>The law of the Federal Republic of Germany applies. Exclusive place of jurisdiction for all disputes arising from this
contractual relationship with merchants is, to the extent legally permissible, Esslingen am Neckar.</p>

<h3>§ 10 Severability Clause</h3>
<p>Should individual provisions of these T&amp;C be invalid, the validity of the remaining provisions shall remain unaffected.</p>

<p><em>Last updated: April 2026</em></p>
HTML;
    }

    private function cookiesEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation of the German Cookie Policy.
<a href="?lang=de">View German version</a>
</p>

<h2>Cookie Policy</h2>

<p>This website uses cookies and comparable technologies. The use of non-essential cookies is subject to your
consent under § 25 (1) TDDDG and Art. 6 (1) lit. a GDPR.</p>

<h3>1. What are cookies?</h3>
<p>Cookies are small text files stored on your device when you visit a website. They allow your browser to be
recognised on a return visit.</p>

<h3>2. Which cookies do we use?</h3>
<ul>
  <li><strong>Strictly necessary cookies</strong> (legal basis: § 25 (2) no. 2 TDDDG):
    required for the operation of the website (e.g. session cookie, CSRF protection, cookie consent).</li>
  <li><strong>Functional cookies</strong> (legal basis: consent):
    user language and preferences.</li>
  <li><strong>Analytics / marketing cookies</strong> (legal basis: consent):
    not currently in use; should they be activated, a detailed list will be added here.</li>
</ul>

<h3>3. Manage consent</h3>
<p>You can adjust or withdraw your cookie settings at any time by re-opening the cookie banner via the
"Cookie Settings" link in the footer or by deleting cookies directly in your browser. Withdrawal of consent
does not affect the lawfulness of processing carried out up to that point.</p>

<h3>4. Storage period</h3>
<p>Session cookies are deleted automatically when your browser session ends. Persistent cookies have a maximum
lifetime of 12 months unless otherwise stated. The consent itself is stored for 13 months following the
recommendation of the German Data Protection Conference (DSK).</p>

<p><em>Last updated: April 2026</em></p>
HTML;
    }

    private function widerrufEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. The German version is legally authoritative.
<a href="?lang=de">View German version</a>
</p>

<h2>Right of Withdrawal for Consumers</h2>

<p>Consumers generally have a right of withdrawal under § 312g BGB for off-premises contracts and distance contracts.
A consumer is any natural person who concludes a legal transaction for purposes that are predominantly outside
their trade, business or profession.</p>

<h3>Right of withdrawal</h3>
<p>You have the right to withdraw from this contract within fourteen days without giving any reason. The withdrawal
period is fourteen days from the day of conclusion of the contract.</p>

<p>To exercise your right of withdrawal you must inform us</p>
<p><strong>StepNow Rides &amp; Movers e.K.</strong><br>
Blumenstraße 8, 73779 Deizisau, Germany<br>
Phone: +49 159 01228856<br>
Email: info@step-now.de</p>
<p>by means of a clear declaration (e.g. a letter sent by post or email) of your decision to withdraw from this contract.</p>

<h3>Consequences of withdrawal</h3>
<p>If you withdraw from this contract we will reimburse all payments received from you without delay and at the
latest within fourteen days from the day on which we receive notification of your withdrawal. For this reimbursement
we will use the same means of payment that you used for the original transaction, unless expressly agreed otherwise with you.</p>

<h3>Exclusion of the right of withdrawal for transport contracts</h3>
<p>Under § 312g (2) no. 9 BGB the right of withdrawal does not apply to contracts for the provision of services in
connection with the transport of persons where the contract specifies a particular date or period of performance.</p>

<p><em>Last updated: April 2026</em></p>
HTML;
    }
}
