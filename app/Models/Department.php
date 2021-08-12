<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'parent_id',
        'lft',
        'rgt',
        'name',
        'background',
        'head_id',
        'displayorder',
    ];

    // Mutators
    public function getTitleAttribute() {
        $dividers = '';
        $count = $this->parents()
            ->with('parents')
            ->count();

        for ($i=0; $i < $count; $i++) {
            $dividers .= '-';
        }
        return $dividers.$this->name;
    }

    public function getDepartmentPathAttribute() {
        $titles = $this->parents()
            ->with('parents')
            ->get()
            ->implode('name', '/');
        return $titles
            ? $titles .'/'. $this->name
            : $this->name;
    }

    public function getLevelAttribute() {
        return count( $this->getParents($this) );
        return $this->parents()
            ->with('parents')
            ->count();
    }

    // Other methods
    public function getParents($model):array {
        $parents = [];
        $has = true;
        while ($has) {
            $data = self::where('parent_id', $model->parent_id)->first();
            if ($data) {
                $parents[] = $data;
                $model = $data;
            } else $has = false;
        }
        return $parents;
    }

    // Relationships
    public function child() {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id')->with('child');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function parents() {
        return $this->belongsTo(self::class, 'parent_id')->with('parent');
    }
}
