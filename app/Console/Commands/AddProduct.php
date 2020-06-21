<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;

class AddProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:product {id} {--name=lee}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        //$id = $this->argument('id');
        //$option = $this->option('action');
        //print $option;
        //print_r($id);
        //$this->info($id);
       // $this->addPr();
       //$this->delProduct();
       $this->updateProduct();
    }

    public function addPr() {
        Product::create([
            "name" => "Test Product2"
        ]);

        //print_r($a);
    }

    public function getProduct() {
        $p =  Product::find($id = $this->argument('id'));
        print $p->name;
        //print_r($a);
    }

    public function delProduct() {
         Product::find($this->argument('id'))->delete();
        //print $p->name;
        //print_r($a);
    }

    public function updateProduct() {
        
        $id = $this->argument("id");
        $name = $this->option("name");
        $p = Product::find($id);
        $p->name = $name;
        $p->save();
       //print $p->name;
       //print_r($a);
       //print $id."::".$name;
   }
}
