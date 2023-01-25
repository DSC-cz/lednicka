<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fridge as Fridge_Model;

class Fridge extends Controller
{
    private $model;
    protected $page;

    public function __construct(){
        $this->model = new Fridge_Model();
    }

    public function index($page = 1){
        $items_per_page = 6;
        $this->page = $page;
        $fridge_data = $this->getData($this->page, $items_per_page);

        return view('fridge.main', ['page'=>$this->page, 'items'=>$fridge_data, 'page_count'=>$this->pageCount($items_per_page) ]);
    }

    public function detail($id){
        $item_data = $this->getItemData($id);

        return view('fridge.detail', ['item'=>$item_data]);
    }

    public function delete($id){
        $this->model->deleteItem($id);

        return redirect('/');
    }

    public function add(){
        return view('fridge.add');
    }

    public function add_submit(Request $req){
        $inputs = $req->input();
        $imageName = null;
        $fotka = $req->file('fotka');

        $req->validate([
            'nazev' => 'required',
            'datum_nakupu' => 'required',
            'datum_trvanlivost' => 'required',
            'fotka' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
        ]);

        if(isset($fotka)){
            $imageName = uniqid() . '.' . $fotka->getClientOriginalExtension();
            $move = $fotka->move(public_path('\images'), $imageName);
            if(!$move) throw new Exception("nenahrála se fotka");
        }

        $insert = $this->model->insert($inputs['nazev'], $inputs['datum_vyroby'], $inputs['datum_nakupu'], $inputs['datum_trvanlivost'], $inputs['datum_spotreby'], $imageName);
        return redirect('/fridge/detail/'.$insert);
    }

    public function edit($id){
        $data = $this->getItemData($id)[0];

        return view('fridge.edit', ['id'=>$id, 'item'=>$data]);
    }

    public function edit_submit($id, Request $req){
        $inputs = $req->input();
        $fotka = $req->file('fotka');
        $imageName = $inputs['aktualni_fotka'];

        $req->validate([
            'nazev' => 'required',
            'datum_nakupu' => 'required',
            'datum_trvanlivost' => 'required',
            'fotka' => 'image|mimes:jpeg,png,jpg,svg|max:5048',
        ]);

        if(isset($fotka)){
            $imageName = (!empty($inputs['aktualni_fotka']) ? $inputs['aktualni_fotka'] : uniqid() . '.' . $fotka->getClientOriginalExtension());
            $fotka->move(public_path('\images'), $imageName);
        }

        $this->model->edit($id, $inputs['nazev'], $inputs['datum_vyroby'], $inputs['datum_nakupu'], $inputs['datum_trvanlivost'], $inputs['datum_spotreby'], $imageName);
        return redirect('/fridge/detail/'.$id);
    }

    protected function getData($page, $items_per_page){
        return $this->model->select($page, $items_per_page);
    }

    protected function getItemData($id){
        return $this->model->item($id);
    }

    protected function pageCount($items_per_page){
        return $this->model->pageCount($items_per_page);
    }
}
