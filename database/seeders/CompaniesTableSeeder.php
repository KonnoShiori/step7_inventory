<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Company::create([
            'company_name'=>'株式会社　れもん',
            'street_address'=>'東京都港区六本木6-10-1 六本木ヒルズ森タワー8F',
            'representative_name'=> '浦島　太郎',
        ]);

        company::create([
            'company_name'=>'株式会社　TOKAGE',
            'street_address'=>'秋田県秋田市川尻町大川反１７０−１０２',
            'representative_name'=> '蛇山　蛇尾',
        ]);

        company::create([
            'company_name'=>'株式会社　にゃー',
            'street_address'=>'熊本市中央区手取本町8番2号テトリアくまもとビル 1階',
            'representative_name'=> '熊本　熊山',
        ]);
    }

}
