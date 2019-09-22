<?php 

if (! function_exists('AccessProfileMiddleware')) {

    /**
     * [AccessProfileMiddleware "Funcao que padroniza o retorna da string middleware para teste"]
     * @param [String]  $nameParamProjectId [Nome da propriedade do requeste que contem o valor do id do Projeto]
     * @param [int]     $permissionId       [ID da permissao a ser testada]
     */
    function AccessProfileMiddleware($nameParamProjectId, $permissionId)
    {
        return 'accessProfileMiddleware:' . (string)$nameParamProjectId . ',' . (string)$permissionId;
    }

}