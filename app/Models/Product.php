<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sku',
        'name',
        'category',
        'price',
    ];    
    /**
     * Get Final Price based on discount_percent
     */
    public function getFinalPrice(){
        if($this->category == 'insurance'){
            return $this->price*70/100;
        }else if($this->sku == '000003'){
            return $this->price*85/100;
        }else{
            return $this->price;
        }
    }
    /**
     * Get discount percet
     */
    public function getDiscount(){
        return $this->category == 'insurance' ? "30%" : ($this->sku == '000003' ? '15%' : null);
    }

    /**
     * Return price array with discount
     */
    public function getPrice(){
        return [
            'original'  => $this->price,
            'final'     => $this->getFinalPrice(),
            'discount_percentage' => $this->getDiscount(),
            'currency' => 'EUR',
        ];
    }
}
