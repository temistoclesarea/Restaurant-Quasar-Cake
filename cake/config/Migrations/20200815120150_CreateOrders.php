<?php
use Migrations\AbstractMigration;

class CreateOrders extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('orders');
        $table->addColumn('paymant_method', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('paymant_price', 'decimal', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('total', 'decimal', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('status', 'string', [
            'default' => 'payment',
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('restaurant_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('address_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->create();
    }
}
