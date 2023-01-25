<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fridge extends Model
{
    use HasFactory;

    public function select($page, $items_per_page){
        return DB::select('SELECT * FROM fridge ORDER BY datum_trvanlivost DESC, datum_spotreby DESC LIMIT ? OFFSET ?', [$items_per_page, (($page-1)*$items_per_page)]);
    }

    public function insert($nazev, $datum_vyroby = null, $datum_nakupu, $datum_trvanlivost, $datum_spotreby = null, $fotka = null){
        $polocas_spotreby = date("Y-m-d H:i:s", round((($datum_vyroby ? strtotime($datum_vyroby) : strtotime($datum_nakupu)) + ($datum_spotreby ? strtotime($datum_spotreby) : strtotime($datum_trvanlivost)))/2, 0));
        return DB::table('fridge')->insertGetId([
            'nazev'=>$nazev,
            'datum_vyroby'=>$datum_vyroby,
            'datum_nakupu'=>$datum_nakupu,
            'datum_trvanlivost'=>$datum_trvanlivost,
            'datum_spotreby'=>$datum_spotreby,
            'polocas_spotreby'=>$polocas_spotreby,
            'fotka'=>$fotka
        ]);
    }

    public function edit($id, $nazev, $datum_vyroby = null, $datum_nakupu, $datum_trvanlivost, $datum_spotreby = null, $fotka = null){
        $polocas_spotreby = date("Y-m-d H:i:s", round((($datum_vyroby ? strtotime($datum_vyroby) : strtotime($datum_nakupu)) + ($datum_spotreby ? strtotime($datum_spotreby) : strtotime($datum_trvanlivost)))/2, 0));
        return DB::table('fridge')->where('id','=',$id)->update([
            'nazev'=>$nazev,
            'datum_vyroby'=>$datum_vyroby,
            'datum_nakupu'=>$datum_nakupu,
            'datum_trvanlivost'=>$datum_trvanlivost,
            'datum_spotreby'=>$datum_spotreby,
            'polocas_spotreby'=>$polocas_spotreby,
            'fotka'=>$fotka
        ]);
    }

    public function deleteItem($id){
        return DB::table('fridge')->where('id','=',$id)->delete();
    }

    public function item($id){
        return DB::select("SELECT * FROM fridge WHERE id = ?", [$id]);
    }

    public function pageCount($items_per_page){
        $rows = DB::select('SELECT COUNT(*) as `count` FROM fridge');

        return ceil($rows[0]->count/$items_per_page);
    }
}
