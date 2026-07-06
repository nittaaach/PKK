<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EvalProgramPokja3 extends Model {
    use HasFactory;
    protected $table = 'eval_program_pokja3';
    protected $fillable = [
        'program_pokok','program_prioritas','jenis_kegiatan','tujuan',
        'output_hasil','sasaran','volume','lokasi','jadwal_kegiatan','mitra_lembaga','keterangan'
    ];
}
