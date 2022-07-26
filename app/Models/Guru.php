<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Guru extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_guru');
    }

    public function image()
    {
        if ($this->foto && file_exists(public_path('images/guru/' . $this->foto))) {
            return asset('images/guru/' . $this->foto);
        } else {
            return asset('images/no_image.jpg');
        }
    }

    public function deleteImage()
    {
        if ($this->foto && file_exists(public_path('images/guru/' . $this->foto))) {
            return unlink(public_path('images/guru/' . $this->foto));
        }
    }

    public static function boot()
    {
        parent::boot();
        self::deleted(function ($parameter) {
            if ($parameter->siswa->count() > 0) {
                $html = 'Guru tidak bisa dihapus karena masih memiliki siswa : ';
                $html .= '<ul>';
                foreach ($parameter->siswa as $data) {
                    $html .= "<li>$data->nama</li>";
                }
                $html .= '</ul>';

                Session::flash("flash_notification", [
                    "level" => "danger",
                    "message" => $html,
                ]);

                return false;
            }
        });
    }
}
