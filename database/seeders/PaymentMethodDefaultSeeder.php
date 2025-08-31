<?php
namespace Database\Seeders;

use App\Models\PaymentMethodDefault;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PaymentMethodDefaultSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        PaymentMethodDefault::truncate();
        Schema::enableForeignKeyConstraints();

        $methods = [
            // Cartões
            ['name' => 'Cartão de Crédito', 'type' => 'credit_card', 'icon' => 'credit-card'],
            ['name' => 'Cartão de Débito', 'type' => 'debit_card', 'icon' => 'debit-card'],
            ['name' => 'Cartão de Refeição', 'type' => 'card', 'icon' => 'restaurant-menu'],
            ['name' => 'Cartão de Alimentação', 'type' => 'card', 'icon' => 'shopping-basket'],
            ['name' => 'Cartão Pré-pago', 'type' => 'card', 'icon' => 'card-giftcard'],

            // Contas e Transferências
            ['name' => 'PIX', 'type' => 'pix', 'icon' => 'pix'],
            ['name' => 'Conta Corrente', 'type' => 'bank_account', 'icon' => 'account-balance'],
            ['name' => 'Conta Poupança', 'type' => 'bank_account', 'icon' => 'savings'],
            ['name' => 'TED / DOC', 'type' => 'bank_transfer', 'icon' => 'swap-horiz'],

            // Carteiras Digitais
            ['name' => 'Carteira Digital', 'type' => 'digital_wallet', 'icon' => 'account-balance-wallet'],
            ['name' => 'PicPay', 'type' => 'digital_wallet', 'icon' => 'monetization-on'],
            ['name' => 'Mercado Pago', 'type' => 'digital_wallet', 'icon' => 'storefront'],

            // Outros
            ['name' => 'Dinheiro', 'type' => 'cash', 'icon' => 'money'],
            ['name' => 'Boleto', 'type' => 'bill', 'icon' => 'receipt'],
            ['name' => 'Criptomoedas', 'type' => 'crypto', 'icon' => 'currency-bitcoin'],
        ];

        foreach ($methods as $method) {
            PaymentMethodDefault::create($method);
        }
    }
}
