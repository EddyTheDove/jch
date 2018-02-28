<?php

use Illuminate\Database\Seeder;
use App\Models\Report;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reports = [
            [
                'name'      => 'Basic Report',
                'slug'      => 'basic',
                'amount'    => 4000,
                'description' => "<p>The basic report is the best option if you are not sure where to start. This report includes:</p>
<ul>
<li>Japanese Auction Records</li>
<li>English translation available</li>
<li>Past repairs</li>
<li>Auction report
<ul>
<li>Location</li>
<li>Date</li>
<li>Grade</li>
<li>Sale Price</li>
</ul>
</li>
<li>Car images</li>
<li>Ideal pre-purchase check</li>
</ul>
<p>This information is often very revealing and may be all you need to know about a vehicle, particularly if you are considering buying it. Obtaining the auction records independently is a good way to check whether a seller is telling you the truth about kms and condition or has supplied a genuine auction report (these are often digitally falsified - changing grade R (repaired) to grade 4 for example).</p>
<p>You could upgrade to Full Report later if you would like further information such as past registration dates &amp; km readings to provide a more comprehensive picture of the vehicle's Japanese history.</p>
<p><strong>Notes</strong>:</p>
<p>Auction records start <strong>from 2007 onwards</strong>. So for vehicles exported from Japan in 2006 or earlier, please consider our <strong>Intermediate report</strong> instead.</p>
<p>&nbsp;</p>"
            ], [
                'name'      => 'Intermediate Report',
                'slug'      => 'intermediate',
                'amount'    => 8500,
                'description' => "<p>The Intermediate Report is a good option when Japanese auction records are not available.&nbsp;</p>
<ul>
<li >Japanese Registration Authority Records</li>
<li >Provided&nbsp;in PDF within 2 business days (in English)</li>
<li >Last&nbsp;two (2) registration dates* and km readings** in Japan</li>
<li >Use&nbsp;this data to check whether kms showing on the vehicle are genuine</li>
<li >Chec<em>k&nbsp;</em><em>whether the Export Certificate supplied by a seller is genuine</em></li>
</ul>
<p>The report also includes:</p>
<ul>
<li>Manufacture date</li>
<li>Deregistration date and location</li>
<li>Reported accidents, theft, hail, flood and fire damage</li>
<li>Airbag deployment</li>
<li>Manufacturer recalls</li>
<li>Commercial usage</li>
<li>Radiation testing (if applicable)</li>
<li>Factory &amp; general specifications</li>
</ul>
<p><strong>Notes</strong></p>
<p>Please be certain the vehicle was registered in Japan before requesting this check as we cannot refund once data has been sought from the Japanese Transport Authority.</p>
<p>*Typically the&nbsp;<strong>last two registration events&nbsp;</strong>are retrievable (depending on vehicle age and export date)</p>
<p>**<strong>Km readings were only recorded at registration events from&nbsp;</strong><strong>2004</strong></p>
<p>Service history/records are held by the previous vehicle owner (not the Japanese Registration Authority) so are not publicly available information</p>"
            ], [
                'name'      => 'Full Report',
                'slug'      => 'full',
                'amount'    => 11000,
                'description' => "<p>The Full Report includes Basic + Intermediate reports.&nbsp;</p>
<ul>
<li >Japanese Auction&nbsp;Records + Registration Records</li>
<li >May provide several km readings going back to 2004</li>
<li >Auction event/s&nbsp;&ndash; date &amp; location, km,&nbsp;condition, repairs,&nbsp;auction&nbsp;report, pictures, sale&nbsp;price<sup>#</sup></li>
<li >Registration data &ndash; last two&nbsp;(2) registration dates* and km readings** in Japan</li>
<li >Report supplied in&nbsp;PDF within 2 business days&nbsp;(English translation available)</li>
</ul>
<p>Use this data to check</p>
<ul>
<li><em>rue kms &amp; condition in Japan</em></li>
<li><em>Whether a seller has provided genuine paperwork such as Export&nbsp;</em><em>Certificate&nbsp;</em><em>/ auction report</em></li>
</ul>
<p>The report also includes&nbsp;</p>
<ul>
<li>Manufacture date</li>
<li>Deregistration date and location</li>
<li>Reported accidents, theft, hail, flood and fire damage</li>
<li>Airbag deployment</li>
<li>Manufacturer recalls</li>
<li>Commercial usage</li>
<li>Radiation testing (if applicable)</li>
<li>Factory &amp; general specifications</li>
</ul>
<p>&nbsp;</p>
<p><strong>Notes</strong></p>
<ul>
<li>*Typically the&nbsp;<strong>last two registration events&nbsp;</strong>are retrievable (depending on vehicle age and export date)</li>
<li>**<strong>Km readings were only recorded at registration events from&nbsp;</strong><strong>2004</strong></li>
<li><sup>#&nbsp;</sup>Sale price is not available for all vehicles and will depend on whether this was recorded by the auction at the time. For USS auctions from 2017+, auction result (sale price) data can be purchased at additional cost &ndash; allow + 10 USD if required</li>
<li>Service history / records are held by the previous vehicle owner (not the Japanese Registration Authority) so are not publicly available information</li>
</ul>"
            ]
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }

    }
}
