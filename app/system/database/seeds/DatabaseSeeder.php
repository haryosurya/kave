<?php namespace System\Database\Seeds;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $siteUrl = 'http://localhost/';

    public static $siteName = 'KAve';

    public static $siteEmail = 'admin@admin.com';

    public static $staffName = 'Admin';

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $this->call([
            InitialSchemaSeeder::class,
            DemoSchemaSeeder::class,
            // UpdateRecordsSeeder::class,
        ]);
    }
}
