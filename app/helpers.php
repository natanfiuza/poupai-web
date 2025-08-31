<?php



if (! function_exists('formatar_moeda_brl')) {
    /**
     * Formata um valor numérico para o padrão de moeda brasileiro (BRL).
     *
     * @param float $valor O valor a ser formatado.
     * @return string O valor formatado como "R$ 1.234,56".
     */
    function formatar_moeda_brl(float $valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}


if (! function_exists('create_storage_directories')) {

    /**
     * Cria os diretórios necessários para armazenar documentos e arquivos temporários.
     *
     * @param string $path_documents Nome do diretório para documentos (valor de env('PATH_DOCUMENTS')).
     * @param string $path_sub_directories Nome do subdiretório para arquivos temporários (valor de env('PATH_DOCUMENTS_PDF_TEMP','pdf_temp') Usar com o valor default).
     */
    function create_storage_directories(string $path_documents, string $path_sub_directories): string
    {

        $base_path = storage_path('app' . DIRECTORY_SEPARATOR);

        // Cria o diretório base 'app', se não existir.
        if (! file_exists($base_path)) {
            mkdir($base_path, 0777, true);
        }

        //Cria o path completo dos documentos
        $full_path_documents = $base_path . $path_documents;

        // Cria o diretório de documentos, se não existir.
        if (! file_exists($full_path_documents)) {
            mkdir($full_path_documents, 0777, true);
        }

        //Cria o path completo dos arquivos
        $full_path_subdir = $full_path_documents . DIRECTORY_SEPARATOR . $path_sub_directories;
        // Cria o subdiretório de arquivos, se não existir.
        if (! file_exists($full_path_subdir)) {
            mkdir($full_path_subdir, 0777, true);
        }
        return $full_path_subdir;
    }

}
