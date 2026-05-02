<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Bilingual policy pages — German is the LEGAL source of truth,
 * English is a courtesy translation.
 *
 * UPDATED 2026-05-02:
 *   - Impressum now states "Erteilt durch das Landratsamt Esslingen" (was
 *     "Antrag in Bearbeitung") per business decision after concession grant.
 *   - AGB expanded to 13 paragraphs with carrier-specific clauses
 *     (cancellation tiers, no-show fee, soiling fee, parcel exclusions,
 *      § 312g (2) Nr. 9 BGB carve-out, §§ 407 ff. HGB).
 *
 * Schema (after migrations 2025_11_12_000009 + 2026_04_29_000002):
 *   id, title, page_title, page_title_en, description, description_en,
 *   order_no, status, timestamps.
 *
 * Re-seed (idempotent — uses updateOrInsert by id):
 *   php artisan db:seed --class=Database\\Seeders\\PolicySeeder --force
 */
class PolicySeeder extends Seeder
{
    public function run(): void
    {
        $policies = [
            [
                'id' => 1, 'title' => 'Impressum',
                'page_title' => 'Impressum', 'page_title_en' => 'Imprint',
                'description'    => $this->impressum(),
                'description_en' => $this->impressumEn(),
                'order_no' => 1, 'status' => 'active',
                'created_at' => '2026-04-24 12:00:00', 'updated_at' => now(),
            ],
            [
                'id' => 2, 'title' => 'Datenschutzerklärung',
                'page_title' => 'Datenschutzerklärung', 'page_title_en' => 'Privacy Policy',
                'description'    => $this->datenschutz(),
                'description_en' => $this->datenschutzEn(),
                'order_no' => 2, 'status' => 'active',
                'created_at' => '2026-04-24 12:00:00', 'updated_at' => now(),
            ],
            [
                'id' => 3, 'title' => 'Allgemeine Geschäftsbedingungen',
                'page_title' => 'AGB', 'page_title_en' => 'Terms & Conditions',
                'description'    => $this->agb(),
                'description_en' => $this->agbEn(),
                'order_no' => 3, 'status' => 'active',
                'created_at' => '2026-04-24 12:00:00', 'updated_at' => now(),
            ],
            [
                'id' => 4, 'title' => 'Cookie-Richtlinie',
                'page_title' => 'Cookie-Richtlinie', 'page_title_en' => 'Cookie Policy',
                'description'    => $this->cookies(),
                'description_en' => $this->cookiesEn(),
                'order_no' => 4, 'status' => 'active',
                'created_at' => '2026-04-24 12:00:00', 'updated_at' => now(),
            ],
            [
                'id' => 5, 'title' => 'Widerrufsbelehrung',
                'page_title' => 'Widerrufsbelehrung', 'page_title_en' => 'Right of Withdrawal',
                'description'    => $this->widerruf(),
                'description_en' => $this->widerrufEn(),
                'order_no' => 5, 'status' => 'active',
                'created_at' => '2026-04-24 12:00:00', 'updated_at' => now(),
            ],
        ];

        foreach ($policies as $row) {
            DB::table('policies')->updateOrInsert(['id' => $row['id']], $row);
        }
    }

    /* ==========================================================================
     |  Impressum  (e.K. with HRA 742905, PBefG concession granted)
     * ==========================================================================*/
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
Konzession für den Mietwagenverkehr nach § 2 Abs. 1 Nr. 4 PBefG: Erteilt durch das Landratsamt Esslingen.
</p>

<p>
Zuständige Aufsichts- und Genehmigungsbehörde:<br>
Landratsamt Esslingen<br>
Pulverwiesen 11<br>
73726 Esslingen am Neckar<br>
Deutschland
</p>

<h3>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h3>
<p>Naeem Ahmad, Anschrift wie oben</p>

<h3>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h3>
<p>
Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
</p>

<h3>Haftung für Inhalte</h3>
<p>
Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich.
Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu
überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung
oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung
ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden
Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
</p>

<h3>Haftung für Links</h3>
<p>
Unser Angebot enthält ggf. Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir
für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter
oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße
überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Bei Bekanntwerden von Rechtsverletzungen
werden wir derartige Links umgehend entfernen.
</p>

<h3>Urheberrecht</h3>
<p>
Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht.
Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.
</p>

<p><em>Stand: Mai 2026</em></p>
HTML;
    }

    private function impressumEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. The German version is legally authoritative.
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

<h3>Regulatory Authority / Licence</h3>
<p>
Licence for hire-car transport under § 2 (1) no. 4 PBefG: granted by the District Office of Esslingen (Landratsamt Esslingen).
</p>

<p>
Competent supervisory and licensing authority:<br>
Landratsamt Esslingen, Pulverwiesen 11, 73726 Esslingen am Neckar, Germany
</p>

<h3>Responsible for content under § 18 (2) MStV</h3>
<p>Naeem Ahmad, address as above.</p>

<h3>Consumer Dispute Resolution</h3>
<p>We are neither willing nor obliged to participate in dispute resolution proceedings before a consumer arbitration board.</p>

<h3>Liability for content</h3>
<p>
As a service provider, we are responsible under § 7 (1) DDG for our own content on these pages under the general laws.
According to §§ 8 to 10 DDG, however, we are not obliged as a service provider to monitor transmitted or stored third-party
information or to investigate circumstances that indicate illegal activity. Upon notification of a specific legal infringement,
we will remove the content immediately.
</p>

<h3>Liability for links</h3>
<p>
Our offer may contain links to external third-party websites whose content we have no control over. The respective provider
or operator of the linked pages is always responsible for their content. Upon notification of legal infringements, we will
remove such links immediately.
</p>

<h3>Copyright</h3>
<p>
Content and works created by the operators on these pages are subject to German copyright law. Downloads and copies of this
page are permitted only for private, non-commercial use.
</p>

<p><em>Last updated: May 2026</em></p>
HTML;
    }

    /* ==========================================================================
     |  Datenschutz
     * ==========================================================================*/
    private function datenschutz(): string
    {
        return <<<'HTML'
<h2>Datenschutzerklärung</h2>

<p>
Wir freuen uns über Ihr Interesse an unserem Unternehmen. Datenschutz hat einen besonders hohen Stellenwert
für die Geschäftsleitung der StepNow Rides &amp; Movers e.K. Eine Nutzung unserer Internetseiten ist
grundsätzlich ohne Angabe personenbezogener Daten möglich. Sofern eine betroffene Person besondere Services
unseres Unternehmens über unsere Internetseite in Anspruch nehmen möchte, könnte jedoch eine Verarbeitung
personenbezogener Daten erforderlich werden.
</p>

<h3>1. Verantwortlicher für die Datenverarbeitung</h3>
<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Inhaber: Naeem Ahmad<br>
Blumenstraße 8, 73779 Deizisau, Deutschland<br>
Telefon: +49 159 01228856 · E-Mail: info@step-now.de
</p>

<h3>2. Welche Daten erheben wir?</h3>
<p>Bei der Buchung einer Fahrt oder eines Paketdienstes verarbeiten wir folgende Datenkategorien:</p>
<ul>
  <li>Kontaktdaten: Name, Telefonnummer, E-Mail-Adresse</li>
  <li>Fahrtdaten: Abhol- und Zieladresse, Datum, Uhrzeit, Anzahl der Fahrgäste</li>
  <li>Paketdaten: Gewicht, Abmessungen, allgemeine Inhaltsangabe, Empfängerkontakt</li>
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
<p>Daten werden nur an Personen oder Stellen weitergegeben, die zur Durchführung der Leistung erforderlich sind (insbesondere der ausführende Fahrer).</p>

<h3>4a. Hosting &amp; Content Delivery (Cloudflare)</h3>
<p>
Zur sicheren und performanten Auslieferung dieser Website verwenden wir Cloudflare (Cloudflare Inc.,
101 Townsend St, San Francisco, CA 94107, USA). Cloudflare verarbeitet IP-Adressen, Browser-Informationen
und HTTP-Header. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO. Cloudflare ist nach dem EU-US Data Privacy
Framework zertifiziert.
</p>

<h3>4b. Schriftarten (Bunny Fonts)</h3>
<p>
Wir laden Schriftarten von Bunny Fonts (BunnyWay d.o.o., Slowenien, EU). Bunny Fonts ist ein
datenschutzfreundlicher Dienst innerhalb der EU, der keine IP-Adressen protokolliert.
</p>

<h3>5. Speicherdauer</h3>
<p>
Personenbezogene Daten werden nur so lange gespeichert, wie es für den Zweck erforderlich ist oder gesetzliche
Aufbewahrungsfristen es vorschreiben (insb. 10 Jahre für steuerrelevante Belege gemäß § 147 AO).
</p>

<h3>6. Ihre Rechte als betroffene Person</h3>
<ul>
  <li>Auskunft (Art. 15 DSGVO)</li>
  <li>Berichtigung (Art. 16 DSGVO)</li>
  <li>Löschung (Art. 17 DSGVO)</li>
  <li>Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
  <li>Datenübertragbarkeit (Art. 20 DSGVO)</li>
  <li>Widerspruch (Art. 21 DSGVO)</li>
  <li>Widerruf der Einwilligung (Art. 7 Abs. 3 DSGVO)</li>
</ul>

<h3>7. Beschwerderecht bei einer Aufsichtsbehörde</h3>
<p>
<strong>Der Landesbeauftragte für den Datenschutz und die Informationsfreiheit Baden-Württemberg</strong><br>
Lautenschlagerstraße 20, 70173 Stuttgart, Deutschland<br>
Telefon: +49 711 615541-0 · E-Mail: poststelle@lfdi.bwl.de
</p>

<p><em>Stand: Mai 2026</em></p>
HTML;
    }

    private function datenschutzEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. The German version is legally authoritative.
<a href="?lang=de">View German version</a>
</p>

<h2>Privacy Policy</h2>

<p>We welcome your interest in our company. Data protection is of particular importance to the management of StepNow Rides &amp; Movers e.K.</p>

<h3>1. Data controller</h3>
<p>
<strong>StepNow Rides &amp; Movers e.K.</strong><br>
Owner: Naeem Ahmad<br>
Blumenstraße 8, 73779 Deizisau, Germany<br>
Phone: +49 159 01228856 · Email: info@step-now.de
</p>

<h3>2. What data do we collect?</h3>
<ul>
  <li>Contact: name, phone number, email</li>
  <li>Trip: pickup and destination, date, time, number of passengers</li>
  <li>Parcel: weight, dimensions, content (general), recipient contact</li>
  <li>Payment data, only as required for processing</li>
  <li>Technical data: IP address, browser, referrer URL, timestamp</li>
</ul>

<h3>3. Purposes and legal basis</h3>
<ul>
  <li><strong>Contract performance (Art. 6 (1) lit. b GDPR)</strong></li>
  <li><strong>Legal obligations (Art. 6 (1) lit. c GDPR)</strong> — invoice retention under § 147 AO (10 years)</li>
  <li><strong>Legitimate interests (Art. 6 (1) lit. f GDPR)</strong></li>
  <li><strong>Consent (Art. 6 (1) lit. a GDPR)</strong></li>
</ul>

<h3>4a. Hosting &amp; CDN (Cloudflare)</h3>
<p>
We use Cloudflare for secure delivery of this website. Legal basis is Art. 6 (1) lit. f GDPR. Cloudflare is
certified under the EU-US Data Privacy Framework.
</p>

<h3>4b. Fonts (Bunny Fonts)</h3>
<p>We load fonts from Bunny Fonts (BunnyWay d.o.o., Slovenia, EU), a privacy-friendly EU service which does not log IP addresses.</p>

<h3>5. Retention period</h3>
<p>We retain personal data only as long as required for the purpose, or as legally mandated (in particular 10 years for tax-relevant documents under § 147 AO).</p>

<h3>6. Your rights</h3>
<ul>
  <li>Access (Art. 15)</li><li>Rectification (Art. 16)</li><li>Erasure (Art. 17)</li>
  <li>Restriction (Art. 18)</li><li>Portability (Art. 20)</li>
  <li>Objection (Art. 21)</li><li>Withdraw consent (Art. 7 (3))</li>
</ul>

<h3>7. Right to lodge a complaint</h3>
<p>
<strong>The State Commissioner for Data Protection and Freedom of Information of Baden-Württemberg</strong><br>
Lautenschlagerstraße 20, 70173 Stuttgart, Germany<br>
Phone: +49 711 615541-0 · Email: poststelle@lfdi.bwl.de
</p>

<p><em>Last updated: May 2026</em></p>
HTML;
    }

    /* ==========================================================================
     |  AGB — expanded with carrier-specific clauses
     * ==========================================================================*/
    private function agb(): string
    {
        return <<<'HTML'
<h2>Allgemeine Geschäftsbedingungen (AGB)</h2>

<h3>§ 1 Geltungsbereich, Anbieter</h3>
<p>
Diese AGB gelten für sämtliche Verträge zwischen <strong>StepNow Rides &amp; Movers e.K.</strong> (im Folgenden: „Anbieter") und dem Kunden über die Erbringung von Personenbeförderungs-, Mietwagen- und Paketdienstleistungen.
</p>

<h3>§ 2 Vertragsschluss</h3>
<p>
Anfragen über die Website oder per Telefon/E-Mail stellen ein unverbindliches Angebot des Kunden dar. Der Vertrag kommt erst durch ausdrückliche Bestätigung (per E-Mail, Telefon oder schriftlich) durch den Anbieter zustande.
</p>

<h3>§ 3 Leistungsumfang</h3>
<p>
Der Anbieter erbringt Personenbeförderung im Mietwagenverkehr nach § 2 Abs. 1 Nr. 4 PBefG sowie Paketzustellungen. Der konkrete Leistungsumfang ergibt sich aus der jeweiligen Auftragsbestätigung.
</p>

<h3>§ 4 Preise und Zahlung</h3>
<p>
Es gelten die zum Zeitpunkt der Buchung veröffentlichten Preise. Alle Preise verstehen sich in Euro. Die Zahlung erfolgt nach Vereinbarung in bar, per Überweisung oder per gängiger digitaler Zahlungsmethode unmittelbar nach Leistungserbringung.
</p>

<h3>§ 5 Stornierung und No-Show</h3>
<ul>
  <li>Stornierung bis 24 Stunden vor dem vereinbarten Termin: kostenfrei.</li>
  <li>Stornierung zwischen 24 und 4 Stunden vor dem Termin: 50&nbsp;% des vereinbarten Fahrpreises.</li>
  <li>Stornierung weniger als 4 Stunden vor dem Termin oder Nichterscheinen (No-Show): 100&nbsp;% des vereinbarten Fahrpreises.</li>
  <li>Bei Flughafentransfers verlängert sich die Wartezeit ohne Aufpreis um bis zu 60 Minuten ab Landung; danach 0,75&nbsp;€ je angefangene Minute.</li>
</ul>

<h3>§ 6 Wartezeiten und Sondertermine</h3>
<p>
Über die im Auftrag vereinbarte Wartezeit hinausgehende Wartezeit wird mit 0,75&nbsp;€ je Minute berechnet, sofern nichts anderes vereinbart ist. Sondertermine (Nachtfahrten 22:00–06:00 Uhr, Sonn- und Feiertage) können einen Zuschlag von bis zu 25&nbsp;% auslösen; dieser ist vor Vertragsschluss explizit auszuweisen.
</p>

<h3>§ 7 Verhalten und Gepäck</h3>
<p>
Im Fahrzeug ist das Rauchen, der Konsum von Alkohol und das Mitführen offener Lebensmittel nicht gestattet. Der Kunde hat sicherzustellen, dass mitgeführtes Gepäck den im Fahrzeug zur Verfügung stehenden Raum nicht überschreitet. Bei Verschmutzung oder Beschädigung des Fahrzeugs durch den Kunden wird eine pauschale Reinigungsgebühr in Höhe von 50&nbsp;€ erhoben; weitergehende Schadensersatzansprüche bleiben unberührt.
</p>

<h3>§ 8 Paketdienst — besondere Bedingungen</h3>
<ul>
  <li>Maximalgewicht je Paket: 30&nbsp;kg. Maximale Außenmaße: 120 × 60 × 60&nbsp;cm.</li>
  <li>Der Inhalt ist vom Kunden wahrheitsgemäß zu deklarieren.</li>
  <li>Ausgeschlossen vom Transport sind insbesondere: Gefahrgut im Sinne des ADR/IATA, Bargeld, Edelmetalle, lebende Tiere, verderbliche Lebensmittel, Waffen, Betäubungsmittel sowie Gegenstände, deren Beförderung gegen geltendes Recht verstößt.</li>
  <li>Für den Pakettransport gelten ergänzend die §§ 407 ff. HGB.</li>
</ul>

<h3>§ 9 Haftung</h3>
<p>
Der Anbieter haftet unbeschränkt für Vorsatz und grobe Fahrlässigkeit sowie nach dem Produkthaftungsgesetz. Bei leichter Fahrlässigkeit haftet der Anbieter nur bei Verletzung einer wesentlichen Vertragspflicht und begrenzt auf den vertragstypisch vorhersehbaren Schaden. Bei Personenbeförderung gelten die zwingenden Haftungsregeln des PBefG.
</p>

<h3>§ 10 Widerrufsrecht (Verbraucher)</h3>
<p>
Verbraucher haben grundsätzlich ein Widerrufsrecht; Einzelheiten ergeben sich aus unserer
<a href="/widerrufsbelehrung">Widerrufsbelehrung</a>. Hinweis: Für Verträge zur Personenbeförderung mit fester Termin- oder Zeitbindung besteht nach § 312g Abs. 2 Nr. 9 BGB kein Widerrufsrecht.
</p>

<h3>§ 11 Datenschutz</h3>
<p>Personenbezogene Daten werden ausschließlich im Rahmen der gesetzlichen Bestimmungen verarbeitet (siehe <a href="/datenschutz">Datenschutzerklärung</a>).</p>

<h3>§ 12 Anwendbares Recht und Gerichtsstand</h3>
<p>
Es gilt das Recht der Bundesrepublik Deutschland. Ausschließlicher Gerichtsstand für alle Streitigkeiten aus diesem Vertragsverhältnis mit Kaufleuten ist, soweit gesetzlich zulässig, Esslingen am Neckar.
</p>

<h3>§ 13 Salvatorische Klausel</h3>
<p>Sollten einzelne Bestimmungen dieser AGB unwirksam sein, berührt dies die Wirksamkeit der übrigen Bestimmungen nicht.</p>

<p><em>Stand: Mai 2026</em></p>
HTML;
    }

    private function agbEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. The German version is legally authoritative.
<a href="?lang=de">View German version</a>
</p>

<h2>Terms and Conditions</h2>

<h3>§ 1 Scope, Provider</h3>
<p>These T&amp;C apply to all contracts between <strong>StepNow Rides &amp; Movers e.K.</strong> ("Provider") and the Customer regarding passenger transport, hire-car and parcel delivery services.</p>

<h3>§ 2 Conclusion of Contract</h3>
<p>Requests via the website, phone or email constitute a non-binding offer by the Customer. The contract is formed only upon explicit confirmation by the Provider.</p>

<h3>§ 3 Scope of Services</h3>
<p>The Provider performs passenger transport in hire-car traffic under § 2 (1) no. 4 PBefG and parcel deliveries. The exact scope follows from the booking confirmation.</p>

<h3>§ 4 Prices and Payment</h3>
<p>Prices published at the time of booking apply. All prices are in Euro. Payment is made in cash, by bank transfer, or by common digital payment method directly after the service is performed.</p>

<h3>§ 5 Cancellation and No-Show</h3>
<ul>
  <li>Cancellation up to 24 hours before the agreed time: free of charge.</li>
  <li>Cancellation between 24 and 4 hours before: 50&nbsp;% of the agreed fare.</li>
  <li>Cancellation less than 4 hours before, or no-show: 100&nbsp;% of the agreed fare.</li>
  <li>For airport transfers the waiting time is extended by up to 60 minutes from landing at no extra charge; thereafter €0.75 per started minute.</li>
</ul>

<h3>§ 6 Waiting Time and Special Times</h3>
<p>Waiting time exceeding the agreed amount is charged at €0.75/minute. Night rides (22:00–06:00) and Sundays/holidays may incur a surcharge of up to 25&nbsp;%, disclosed before contract conclusion.</p>

<h3>§ 7 Conduct and Luggage</h3>
<p>Smoking, alcohol consumption and open food are not permitted in the vehicle. Luggage must fit the vehicle. In case of soiling or damage caused by the Customer, a flat cleaning fee of €50 applies; further damage claims remain unaffected.</p>

<h3>§ 8 Parcel Service — Special Terms</h3>
<ul>
  <li>Maximum weight per parcel: 30&nbsp;kg. Maximum outer dimensions: 120 × 60 × 60&nbsp;cm.</li>
  <li>The Customer must declare the contents truthfully.</li>
  <li>Excluded from transport in particular: dangerous goods under ADR/IATA, cash, precious metals, live animals, perishable foods, weapons, narcotics, and any items whose transport violates applicable law.</li>
  <li>For parcel transport, §§ 407 ff. HGB additionally apply.</li>
</ul>

<h3>§ 9 Liability</h3>
<p>The Provider is liable without limitation for intent and gross negligence and under the German Product Liability Act. For slight negligence, liability is limited to breach of essential contractual obligations and to the foreseeable damage typical for the contract. Mandatory liability rules of PBefG apply for passenger transport.</p>

<h3>§ 10 Right of Withdrawal (Consumers)</h3>
<p>Consumers generally have a right of withdrawal; details are set out in our <a href="/widerrufsbelehrung">Right of Withdrawal</a>. Note: Under § 312g (2) no. 9 BGB, no right of withdrawal exists for passenger transport contracts with a fixed performance date or period.</p>

<h3>§ 11 Data Protection</h3>
<p>Personal data is processed exclusively within statutory provisions (see <a href="/datenschutz">Privacy Policy</a>).</p>

<h3>§ 12 Applicable Law and Jurisdiction</h3>
<p>The law of the Federal Republic of Germany applies. Exclusive place of jurisdiction for disputes with merchants is, to the extent legally permissible, Esslingen am Neckar.</p>

<h3>§ 13 Severability Clause</h3>
<p>Should individual provisions of these T&amp;C be invalid, the validity of the remaining provisions shall remain unaffected.</p>

<p><em>Last updated: May 2026</em></p>
HTML;
    }

    /* ==========================================================================
     |  Cookie + Widerruf
     * ==========================================================================*/
    private function cookies(): string
    {
        return <<<'HTML'
<h2>Cookie-Richtlinie</h2>

<p>Diese Website verwendet Cookies und vergleichbare Technologien. Die Nutzung nicht technisch notwendiger Cookies erfolgt gemäß § 25 Abs. 1 TDDDG und Art. 6 Abs. 1 lit. a DSGVO nur mit Ihrer Einwilligung.</p>

<h3>1. Was sind Cookies?</h3>
<p>Cookies sind kleine Textdateien, die beim Besuch einer Website auf Ihrem Gerät gespeichert werden. Sie ermöglichen es, Ihren Browser bei einem erneuten Besuch wiederzuerkennen.</p>

<h3>2. Welche Cookies verwenden wir?</h3>
<ul>
  <li><strong>Technisch notwendige Cookies</strong> (Rechtsgrundlage: § 25 Abs. 2 Nr. 2 TDDDG): erforderlich für den Betrieb der Website (z. B. Session-Cookie, CSRF-Schutz, Cookie-Einwilligung).</li>
  <li><strong>Funktionale Cookies</strong> (Rechtsgrundlage: Einwilligung): Sprache und Voreinstellungen des Nutzers.</li>
  <li><strong>Analyse-/Marketing-Cookies</strong> (Rechtsgrundlage: Einwilligung): derzeit nicht im Einsatz; sollten diese aktiviert werden, wird hier eine detaillierte Liste ergänzt.</li>
</ul>

<h3>3. Einwilligung verwalten</h3>
<p>Sie können Ihre Cookie-Einstellungen jederzeit anpassen oder widerrufen, indem Sie den Cookie-Banner über den Link „Cookie-Einstellungen" im Footer erneut öffnen oder Cookies direkt in Ihrem Browser löschen. Ein Widerruf der Einwilligung berührt die Rechtmäßigkeit der bis dahin erfolgten Verarbeitung nicht.</p>

<h3>4. Speicherdauer</h3>
<p>Session-Cookies werden mit Beendigung Ihrer Browsersitzung automatisch gelöscht. Persistente Cookies haben eine Lebensdauer von maximal 12 Monaten, sofern nichts anderes angegeben ist. Die Einwilligung selbst wird gemäß DSK-Empfehlung 13 Monate gespeichert.</p>

<p><em>Stand: Mai 2026</em></p>
HTML;
    }

    private function cookiesEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. <a href="?lang=de">View German version</a>
</p>

<h2>Cookie Policy</h2>

<p>This website uses cookies and comparable technologies. The use of non-essential cookies is subject to your consent under § 25 (1) TDDDG and Art. 6 (1) lit. a GDPR.</p>

<h3>1. What are cookies?</h3>
<p>Cookies are small text files stored on your device when you visit a website. They allow your browser to be recognised on a return visit.</p>

<h3>2. Which cookies do we use?</h3>
<ul>
  <li><strong>Strictly necessary cookies</strong> (legal basis: § 25 (2) no. 2 TDDDG): required for the operation of the website (e.g. session cookie, CSRF protection, cookie consent).</li>
  <li><strong>Functional cookies</strong> (legal basis: consent): user language and preferences.</li>
  <li><strong>Analytics / marketing cookies</strong> (legal basis: consent): not currently in use; should they be activated, a detailed list will be added here.</li>
</ul>

<h3>3. Manage consent</h3>
<p>You can adjust or withdraw your cookie settings at any time by re-opening the cookie banner via the "Cookie Settings" link in the footer or by deleting cookies directly in your browser. Withdrawal of consent does not affect the lawfulness of processing carried out up to that point.</p>

<h3>4. Storage period</h3>
<p>Session cookies are deleted automatically when your browser session ends. Persistent cookies have a maximum lifetime of 12 months unless otherwise stated. The consent itself is stored for 13 months following the recommendation of the German Data Protection Conference (DSK).</p>

<p><em>Last updated: May 2026</em></p>
HTML;
    }

    private function widerruf(): string
    {
        return <<<'HTML'
<h2>Widerrufsbelehrung für Verbraucher</h2>

<p>Verbrauchern steht nach § 312g BGB ein Widerrufsrecht bei außerhalb von Geschäftsräumen geschlossenen Verträgen und bei Fernabsatzverträgen grundsätzlich zu. Verbraucher ist jede natürliche Person, die ein Rechtsgeschäft zu Zwecken abschließt, die überwiegend weder ihrer gewerblichen noch ihrer selbständigen beruflichen Tätigkeit zugerechnet werden können.</p>

<h3>Widerrufsrecht</h3>
<p>Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.</p>

<p>Um Ihr Widerrufsrecht auszuüben, müssen Sie uns</p>
<p><strong>StepNow Rides &amp; Movers e.K.</strong><br>
Blumenstraße 8, 73779 Deizisau<br>
Telefon: +49 159 01228856<br>
E-Mail: info@step-now.de</p>
<p>mittels einer eindeutigen Erklärung (z. B. ein mit der Post versandter Brief oder E-Mail) über Ihren Entschluss, diesen Vertrag zu widerrufen, informieren.</p>

<h3>Folgen des Widerrufs</h3>
<p>Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, unverzüglich und spätestens binnen vierzehn Tagen ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist.</p>

<h3>Erlöschen des Widerrufsrechts bei Beförderungsverträgen</h3>
<p>Das Widerrufsrecht besteht nach § 312g Abs. 2 Nr. 9 BGB nicht bei Verträgen zur Erbringung von Dienstleistungen im Zusammenhang mit Beförderung von Personen, wenn der Vertrag für die Erbringung einen spezifischen Termin oder Zeitraum vorsieht.</p>

<p><em>Stand: Mai 2026</em></p>
HTML;
    }

    private function widerrufEn(): string
    {
        return <<<'HTML'
<p style="background:#f7f7f7;border-left:4px solid #0d6efd;padding:12px 16px;margin-bottom:24px;font-size:.9rem;">
<strong>Note:</strong> Courtesy translation. <a href="?lang=de">View German version</a>
</p>

<h2>Right of Withdrawal for Consumers</h2>

<p>Consumers generally have a right of withdrawal under § 312g BGB for off-premises contracts and distance contracts.</p>

<h3>Right of withdrawal</h3>
<p>You have the right to withdraw from this contract within fourteen days without giving any reason. The withdrawal period is fourteen days from the day of conclusion of the contract.</p>

<p>To exercise your right of withdrawal, please inform us:</p>
<p><strong>StepNow Rides &amp; Movers e.K.</strong><br>
Blumenstraße 8, 73779 Deizisau, Germany<br>
Phone: +49 159 01228856<br>
Email: info@step-now.de</p>
<p>by means of a clear declaration (e.g. a letter sent by post or email) of your decision to withdraw from this contract.</p>

<h3>Consequences of withdrawal</h3>
<p>If you withdraw from this contract, we will reimburse all payments received from you without delay and at the latest within fourteen days from the day on which we receive notification of your withdrawal.</p>

<h3>Exclusion for transport contracts</h3>
<p>Under § 312g (2) no. 9 BGB, no right of withdrawal applies to contracts for services in connection with the transport of persons where the contract specifies a particular date or period of performance.</p>

<p><em>Last updated: May 2026</em></p>
HTML;
    }
}
