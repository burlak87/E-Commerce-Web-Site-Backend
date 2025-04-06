<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
  public const NAME = 'name';
  public const DESCRIPTION = 'description';
  public const PRICE = 'price';
  public const COLOR = 'color';
  public const SIZE = 'size';
  public const CATEGORY = 'category';
  public const TYPE_PRODUCT = 'type_product';
  public const DRESS_STYLE = 'dress_style';

  public function getCallbacks(): array
  {
    return [
      self::NAME => [$this, 'name'],
      self::DESCRIPTION =>[$this, 'description'],
      self::PRICE => [$this, 'price'],
      self::COLOR => [$this, 'color'],
      self::SIZE =>[$this, 'size'],
      self::CATEGORY => [$this, 'category'],
      self::TYPE_PRODUCT => [$this, 'typeProduct'],
      self::DRESS_STYLE =>[$this, 'dressStyle'],
    ];
  }

  public function name(Builder $builder, $value)
  {
    $builder->where('name', 'like', "%{$value}%");
  }

  public function description(Builder $builder, $value)
  {
    $builder->where('description', 'like', "%{$value}%");
  }

  public function price(Builder $builder, $value)
  {
    $builder->where('price', $value);
  }

  public function color(Builder $builder, $value)
  {
    $builder->where('color', 'like', "%{$value}%");
  }

  public function size(Builder $builder, $value)
  {
    $builder->where('size', 'like', "%{$value}%");
  }

  public function category(Builder $builder, $value)
  {
    $builder->where('category', $value);
  }

  public function typeProduct(Builder $builder, $value)
  {
    $builder->where('type_product', 'like', "%{$value}%");
  }

  public function dressStyle(Builder $builder, $value)
  {
    $builder->where('dress_style', 'like', "%{$value}%");
  }
}