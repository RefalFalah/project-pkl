<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    use HasFactory;

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function image()
    {
        if ($this->foto && file_exists(public_path('images/wali/' . $this->foto))) {
            return asset('images/wali/' . $this->foto);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteImage()
    {
        if ($this->foto && file_exists(public_path('images/wali/' . $this->foto))) {
            return unlink(public_path('images/wali/' . $this->foto));
        }
    }
}
