<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @const int Новый заказ */
    const STATUS_NEW = 0;

    /** @const int Подтвержденный заказ */
    const STATUS_CONFIRMED = 10;

    /** @const int Завершенный заказ */
    const STATUS_FINISHED = 20;

    /** @var string $table */
    public $table = 'orders';

    /** @var array $fillable */
    public $fillable = ['client_email', 'partner_id', 'status'];

    /**
     * Отношение к товарам заказа
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('price', 'quantity');
    }

    /**
     * Отношение к партнерам
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partner(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Partner::class, 'id', 'partner_id');
    }

    /**
     * Возможные статусы заказа
     *
     * @return array
     */
    public function getStatusList(): array
    {
        return [
            self::STATUS_NEW => 'новый',
            self::STATUS_CONFIRMED => 'подтвержден',
            self::STATUS_FINISHED => 'завершен',
        ];
    }

    /**
     * Текущий статус заказа или переданный в $status
     *
     * @param null $status
     * @return string
     */
    public function getStatus($status = null): string
    {
        $status_list = $this->getStatusList();
        if ($status !== null) {
            return isset($status_list[$status]) ? $status_list[$status] : '---';
        }

        return isset($status_list[$this->status]) ? $status_list[$this->status] : '---';
    }

    /**
     * Данные заказа
     *
     * @return array
     */
    public function getData(): array
    {
        $result = [
            'id' => $this->id,
            'client_email' => $this->client_email,
            'products' => collect([]),
            'sum' => 0,
            'status' => $this->getStatus(),
            'partner' => $this->partner,
        ];

        $this->products()->each(function (Product $item) use (&$result) {
            $result['products']->push($item);
            $result['sum'] += ($item->price * $item->quantity);
        });

        return $result;
    }

}
