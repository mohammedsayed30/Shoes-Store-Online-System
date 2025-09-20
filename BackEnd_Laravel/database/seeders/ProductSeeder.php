<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            //sports category
            ['name' => 'sneakers', 'description' => 'Shoes for running and training',
            'price'=>420,'sku'=>'sport-white-420', 'category_id'=>1,
            'image' => 'storage/products/sports/activityshoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>400,'sku'=>'football-blk-400', 'category_id'=>1,
            'image' => 'storage/products/sports/adidasFootballShoes.jpg'],

            ['name' => 'sneakers', 'description' => 'Shoes for running and training',
            'price'=>420,'sku'=>'sport-black-450', 'category_id'=>1,
            'image' => 'storage/products/sports/blackrunningShoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>1050,'sku'=>'football-blue-1050', 'category_id'=>1,
            'image' => 'storage/products/sports/BlueFootballShoes.jpg'],

            ['name' => 'sneakers', 'description' => 'Shoes for running and training',
            'price'=>520,'sku'=>'sport-blue-520', 'category_id'=>1,
            'image' => 'storage/products/sports/blueRunning.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>2000,'sku'=>'football-CR7-2000', 'category_id'=>1,
            'image' => 'storage/products/sports/CR7FootballShoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>800,'sku'=>'football-blue-800', 'category_id'=>1,
            'image' => 'storage/products/sports/ElegantFootballShoes.jpg'],

            ['name' => 'sneakers', 'description' => 'Shoes for running and training',
            'price'=>620,'sku'=>'sport-white-450', 'category_id'=>1,
            'image' => 'storage/products/sports/ElegantRunningShoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>600,'sku'=>'football-FSD-600', 'category_id'=>1,
            'image' => 'storage/products/sports/FootballShoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>850,'sku'=>'football-FSO-850', 'category_id'=>1,
            'image' => 'storage/products/sports/FSOFootballShoes.jpg'],

            ['name' => 'gymshoes', 'description' => 'Shoes for playing and training gym very smoothy',
            'price'=>600,'sku'=>'gym-FSD-600', 'category_id'=>1,
            'image' => 'storage/products/sports/GymShoes.jpg'],

            ['name' => 'trainingshoes', 'description' => 'Shoes for playing and training gym&running very smoothy',
            'price'=>900,'sku'=>'football-nike-900', 'category_id'=>1,
            'image' => 'storage/products/sports/NikeTrainingShoes.jpg'],

            ['name' => 'footballshoes', 'description' => 'Shoes for playing and training football very smoothy',
            'price'=>850,'sku'=>'football-nivia-850', 'category_id'=>1,
            'image' => 'storage/products/sports/FSOFootballShoes.jpg'],
            //Casual category
            ['name' => 'casualshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>850,'sku'=>'casual-canvas-850', 'category_id'=>2,
            'image' => 'storage/products/casual/CanvasShoes.jpg'],

            ['name' => 'casualshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>550,'sku'=>'casual-550', 'category_id'=>2,
            'image' => 'storage/products/casual/Casual.jpg'],

            ['name' => 'casualshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>700,'sku'=>'casual-700', 'category_id'=>2,
            'image' => 'storage/products/casual/CasualShoes.jpg'],

            ['name' => 'casualshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>700,'sku'=>'casual-1000', 'category_id'=>2,
            'image' => 'storage/products/casual/CasualMen.jpg'],

            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>300,'sku'=>'Classic-300', 'category_id'=>2,
            'image' => 'storage/products/casual/Classic.jpg'],

            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>300,'sku'=>'Classic-320', 'category_id'=>2,
            'image' => 'storage/products/casual/ClassicRoasterShoes.jpg'],

            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>250,'sku'=>'Classic-250', 'category_id'=>2,
            'image' => 'storage/products/casual/ClassicShoes.jpg'],

            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>370,'sku'=>'Casual-370', 'category_id'=>2,
            'image' => 'storage/products/casual/ElegantCasualShoes.jpg'],
            
            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>390,'sku'=>'Casual-Brown-390', 'category_id'=>2,
            'image' => 'storage/products/casual/LightBrownShoes.jpg'],

            ['name' => 'Classicshoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>395,'sku'=>'Casual-395', 'category_id'=>2,
            'image' => 'storage/products/casual/MinimalistCasual.jpg'],

            ['name' => 'sliphoes', 'description' => 'elegant shoes for casual wearing',
            'price'=>395,'sku'=>'Slip-395', 'category_id'=>2,
            'image' => 'storage/products/casual/SlipOn.jpg'],

            ['name' => 'SuedeCasual', 'description' => 'elegant shoes for casual wearing',
            'price'=>500,'sku'=>'SuedeCasual-500', 'category_id'=>2,
            'image' => 'storage/products/casual/SuedeCasual.jpg'],

            //formal category
            ['name' => 'formalshoes', 'description' => 'elegant shoes for formal wearing',
            'price'=>1000,'sku'=>'formal-brown-1000', 'category_id'=>3,
            'image' => 'storage/products/formal/BrownFormal.jpg'],
            
            ['name' => 'business', 'description' => 'elegant shoes for formal wearing',
            'price'=>2000,'sku'=>'business-black-2000', 'category_id'=>3,
            'image' => 'storage/products/formal/BusinessShoes.jpg'],

            ['name' => 'formalshoes', 'description' => 'elegant shoes for formal wearing',
            'price'=>500,'sku'=>'formal-brown-500', 'category_id'=>3,
            'image' => 'storage/products/formal/Formal.jpg'],

            ['name' => 'formalshoes', 'description' => 'elegant shoes for formal wearing',
            'price'=>1200,'sku'=>'formal-black-1200', 'category_id'=>3,
            'image' => 'storage/products/formal/formaldressshoes.jpg'],

            ['name' => 'formalshoes', 'description' => 'elegant shoes for formal wearing',
            'price'=>1700,'sku'=>'formal-brown-1700', 'category_id'=>3,
            'image' => 'storage/products/formal/FormalShoes.jpg'],

            ['name' => 'leatherformalshoes', 'description' => 'elegant shoes for formal wearing',
            'price'=>1200,'sku'=>'formal-leather-1200', 'category_id'=>3,
            'image' => 'storage/products/formal/leatherFormal.jpg'],

            ['name' => 'meeting', 'description' => 'elegant shoes for formal wearing',
            'price'=>1300,'sku'=>'meeting-1300', 'category_id'=>3,
            'image' => 'storage/products/formal/meeting.jpg'],

            ['name' => 'meeting', 'description' => 'elegant shoes for formal wearing',
            'price'=>1070,'sku'=>'meeting-1070', 'category_id'=>3,
            'image' => 'storage/products/formal/MeetingShoes.jpg'],

            ['name' => 'meeting', 'description' => 'elegant shoes for formal wearing',
            'price'=>2070,'sku'=>'meeting-2070', 'category_id'=>3,
            'image' => 'storage/products/formal/MenFormal.jpg'],

            ['name' => 'meeting', 'description' => 'elegant shoes for formal wearing',
            'price'=>7080,'sku'=>'meeting-780', 'category_id'=>3,
            'image' => 'storage/products/formal/MenFormalShoes.jpg'],

            //wedding category
            ['name' => 'britishwedding', 'description' => 'elegant shoes for Men  wedding',
            'price'=>4200,'sku'=>'wedding-british-4200', 'category_id'=>4,
            'image' => 'storage/products/wedding/BritishWeddingStyle.jpg'],

            ['name' => 'brownwedding', 'description' => 'elegant shoes for Men  wedding',
            'price'=>900,'sku'=>'wedding-brown-900', 'category_id'=>4,
            'image' => 'storage/products/wedding/BrownWeddingShoes.jpg'],

            ['name' => 'wedding', 'description' => 'elegant shoes for Men  wedding',
            'price'=>900,'sku'=>'wedding-900', 'category_id'=>4,
            'image' => 'storage/products/wedding/ElegentWeddingShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>900,'sku'=>'Groom-900', 'category_id'=>4,
            'image' => 'storage/products/wedding/GroomMenShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>2300,'sku'=>'Groom-2300', 'category_id'=>4,
            'image' => 'storage/products/wedding/GroomShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>900,'sku'=>'Groom-Men-900', 'category_id'=>4,
            'image' => 'storage/products/wedding/groomsShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>1900,'sku'=>'GroomMen-1900', 'category_id'=>4,
            'image' => 'storage/products/wedding/GroomWeddingShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>1900,'sku'=>'LeatherGroomMen-1900', 'category_id'=>4,
            'image' => 'storage/products/wedding/LeatherWeddingShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>1370,'sku'=>'GroomMen-1370', 'category_id'=>4,
            'image' => 'storage/products/wedding/WeddingMenShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>1375,'sku'=>'GroomMen-1375', 'category_id'=>4,
            'image' => 'storage/products/wedding/WeddingShoes.jpg'],

            ['name' => 'Groom', 'description' => 'elegant shoes for Men  wedding',
            'price'=>1380,'sku'=>'Groom-1380', 'category_id'=>4,
            'image' => 'storage/products/wedding/WeddingShoesMen.jpg'],

            //home category

            ['name' => 'house', 'description' => 'comfortable shoes for home',
            'price'=>380,'sku'=>'house-380', 'category_id'=>5,
            'image' => 'storage/products/house/HouseSlipper.jpg'],

            ['name' => 'house', 'description' => 'comfortable shoes for home',
            'price'=>180,'sku'=>'house-Men-180', 'category_id'=>5,
            'image' => 'storage/products/house/MenSlipper.jpg'],

            ['name' => 'OpenToe', 'description' => 'comfortable shoes for home',
            'price'=>400,'sku'=>'OpenToe-400', 'category_id'=>5,
            'image' => 'storage/products/house/OpenToe.jpg'],

            ['name' => 'sandles', 'description' => 'comfortable shoes for home',
            'price'=>200,'sku'=>'sandles-200', 'category_id'=>5,
            'image' => 'storage/products/house/SandlesHome.jpg'],

            ['name' => 'simpleslipper', 'description' => 'comfortable shoes for home',
            'price'=>150,'sku'=>'sliper-150', 'category_id'=>5,
            'image' => 'storage/products/house/SimpleSliper.jpg'],

            ['name' => 'slipper', 'description' => 'comfortable shoes for home',
            'price'=>340,'sku'=>'sliper-340', 'category_id'=>5,
            'image' => 'storage/products/house/Slipper.jpg'],

            ['name' => 'SummerSliper', 'description' => 'comfortable shoes for home',
            'price'=>210,'sku'=>'summersliper-210', 'category_id'=>5,
            'image' => 'storage/products/house/summerslipper.jpg'],

            ['name' => 'waterProofSliper', 'description' => 'comfortable shoes for home',
            'price'=>510,'sku'=>'waterproofsliper-510', 'category_id'=>5,
            'image' => 'storage/products/house/WaterProofSliper.jpg'],

            ['name' => 'winterSliper', 'description' => 'comfortable shoes for home',
            'price'=>470,'sku'=>'wintersliper-470', 'category_id'=>5,
            'image' => 'storage/products/house/wintersliper.jpg'],
            
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
