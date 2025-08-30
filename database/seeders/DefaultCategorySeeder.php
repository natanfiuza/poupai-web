<?php
namespace Database\Seeders;

use App\Models\CategoryDefault;
use Illuminate\Database\Seeder;

class DefaultCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela para evitar duplicatas ao rodar o seeder múltiplas vezes
        CategoryDefault::truncate();

        $categories = [
            // ========== DESPESAS (EXPENSE) ==========

            // --- Moradia ---
            ['name' => 'Aluguel', 'type' => 'expense', 'icon' => 'key', 'color' => '#FF7043'],
            ['name' => 'Condomínio', 'type' => 'expense', 'icon' => 'business', 'color' => '#FF8A65'],
            ['name' => 'Financiamento Imobiliário', 'type' => 'expense', 'icon' => 'home-work', 'color' => '#FFAB91'],
            ['name' => 'Contas de Consumo', 'type' => 'expense', 'icon' => 'receipt-long', 'color' => '#FF7043'],
            ['name' => 'Manutenção da Casa', 'type' => 'expense', 'icon' => 'build', 'color' => '#FF8A65'],
            ['name' => 'IPTU', 'type' => 'expense', 'icon' => 'account-balance', 'color' => '#FFAB91'],

            // --- Alimentação ---
            ['name' => 'Supermercado', 'type' => 'expense', 'icon' => 'shopping-cart', 'color' => '#66BB6A'],
            ['name' => 'Restaurantes e Lanches', 'type' => 'expense', 'icon' => 'restaurant', 'color' => '#81C784'],
            ['name' => 'Delivery', 'type' => 'expense', 'icon' => 'delivery-dining', 'color' => '#A5D6A7'],
            ['name' => 'Feira e Hortifruti', 'type' => 'expense', 'icon' => 'local-florist', 'color' => '#C8E6C9'],

            // --- Transporte ---
            ['name' => 'Combustível', 'type' => 'expense', 'icon' => 'local-gas-station', 'color' => '#5C6BC0'],
            ['name' => 'Transporte Público', 'type' => 'expense', 'icon' => 'directions-bus', 'color' => '#7986CB'],
            ['name' => 'Apps de Transporte', 'type' => 'expense', 'icon' => 'local-taxi', 'color' => '#9FA8DA'],
            ['name' => 'Manutenção do Veículo', 'type' => 'expense', 'icon' => 'car-repair', 'color' => '#C5CAE9'],
            ['name' => 'Seguro e Impostos (IPVA)', 'type' => 'expense', 'icon' => 'shield', 'color' => '#5C6BC0'],

            // --- Saúde e Bem-estar ---
            ['name' => 'Plano de Saúde', 'type' => 'expense', 'icon' => 'health-and-safety', 'color' => '#EF5350'],
            ['name' => 'Farmácia e Medicamentos', 'type' => 'expense', 'icon' => 'medical-services', 'color' => '#E57373'],
            ['name' => 'Consultas e Exames', 'type' => 'expense', 'icon' => 'biotech', 'color' => '#EF9A9A'],
            ['name' => 'Academia e Fitness', 'type' => 'expense', 'icon' => 'fitness-center', 'color' => '#FFCDD2'],

            // --- Lazer e Entretenimento ---
            ['name' => 'Streaming e Assinaturas', 'type' => 'expense', 'icon' => 'subscriptions', 'color' => '#AB47BC'],
            ['name' => 'Viagens e Férias', 'type' => 'expense', 'icon' => 'flight-takeoff', 'color' => '#BA68C8'],
            ['name' => 'Bares e Vida Noturna', 'type' => 'expense', 'icon' => 'nightlife', 'color' => '#CE93D8'],
            ['name' => 'Cinema, Shows e Cultura', 'type' => 'expense', 'icon' => 'theaters', 'color' => '#E1BEE7'],

            // --- Educação ---
            ['name' => 'Cursos e Treinamentos', 'type' => 'expense', 'icon' => 'school', 'color' => '#26A69A'],
            ['name' => 'Mensalidade Escolar', 'type' => 'expense', 'icon' => 'menu-book', 'color' => '#4DB6AC'],
            ['name' => 'Livros e Materiais', 'type' => 'expense', 'icon' => 'book', 'color' => '#80CBC4'],

            // --- Compras Pessoais ---
            ['name' => 'Roupas e Calçados', 'type' => 'expense', 'icon' => 'checkroom', 'color' => '#78909C'],
            ['name' => 'Cosméticos', 'type' => 'expense', 'icon' => 'face', 'color' => '#90A4AE'],
            ['name' => 'Eletrônicos', 'type' => 'expense', 'icon' => 'devices', 'color' => '#B0BEC5'],
            ['name' => 'Presentes', 'type' => 'expense', 'icon' => 'card-giftcard', 'color' => '#CFD8DC'],

            // --- Família e Pets ---
            ['name' => 'Despesas com Filhos', 'type' => 'expense', 'icon' => 'child-care', 'color' => '#FFEE58'],
            ['name' => 'Pets', 'type' => 'expense', 'icon' => 'pets', 'color' => '#FFF176'],

            // --- Outras Despesas ---
            ['name' => 'Taxas Bancárias', 'type' => 'expense', 'icon' => 'payment', 'color' => '#BDBDBD'],
            ['name' => 'Doações', 'type' => 'expense', 'icon' => 'volunteer-activism', 'color' => '#E0E0E0'],
            ['name' => 'Empréstimos e Dívidas', 'type' => 'expense', 'icon' => 'credit-score', 'color' => '#9E9E9E'],

            // ========== RECEITAS (INCOME) ==========

            // --- Renda Principal ---
            ['name' => 'Salário', 'type' => 'income', 'icon' => 'work', 'color' => '#4CAF50'],
            ['name' => 'Pró-labore', 'type' => 'income', 'icon' => 'business-center', 'color' => '#66BB6A'],
            ['name' => 'Aposentadoria', 'type' => 'income', 'icon' => 'elderly', 'color' => '#81C784'],

            // --- Renda Extra ---
            ['name' => 'Freelance e Bicos', 'type' => 'income', 'icon' => 'computer', 'color' => '#29B6F6'],
            ['name' => 'Vendas', 'type' => 'income', 'icon' => 'point-of-sale', 'color' => '#4FC3F7'],
            ['name' => 'Aluguéis Recebidos', 'type' => 'income', 'icon' => 'real-estate-agent', 'color' => '#81D4FA'],

            // --- Investimentos ---
            ['name' => 'Dividendos', 'type' => 'income', 'icon' => 'trending-up', 'color' => '#FFCA28'],
            ['name' => 'Juros', 'type' => 'income', 'icon' => 'percent', 'color' => '#FFD54F'],
            ['name' => 'Venda de Ativos', 'type' => 'income', 'icon' => 'monetization-on', 'color' => '#FFE082'],

            // --- Outras Receitas ---
            ['name' => 'Presentes em Dinheiro', 'type' => 'income', 'icon' => 'redeem', 'color' => '#BCAAA4'],
            ['name' => 'Reembolsos', 'type' => 'income', 'icon' => 'assignment-return', 'color' => '#D7CCC8'],
            ['name' => 'Pensão', 'type' => 'income', 'icon' => 'family-restroom', 'color' => '#EFEBE9'],
        ];

        foreach ($categories as $category) {
            CategoryDefault::create($category);
        }
    }
}
