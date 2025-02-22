<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Array asociativo con los ejemplos de código por lenguaje
$codeExamples = [
    'php' => [
        'code' => '// Ejemplo de integración con PHP
$client = new FiscalApiClient([
    \'api_key\' => \'TU_API_KEY\',
    \'environment\' => \'production\'
]);

try {
    $factura = $client->comprobantes->crear([
        \'tipo_comprobante\' => \'A\',
        \'punto_venta\' => 1,
        \'concepto\' => 1,
        \'doc_tipo\' => 80,
        \'doc_nro\' => \'30712345678\',
        \'fecha\' => date(\'Y-m-d\'),
        \'imp_total\' => 1000.00,
        \'imp_neto\' => 826.45,
        \'imp_iva\' => 173.55
    ]);

    echo "Factura creada con CAE: " . $factura->cae;
} catch (FiscalApiException $e) {
    echo "Error: " . $e->getMessage();
}'
    ],
    'javascript' => [
        'code' => '// Ejemplo con JavaScript
const fiscalApi = new FiscalApi(\'TU_API_KEY\');

async function crearFactura() {
    try {
        const factura = await fiscalApi.comprobantes.crear({
            tipo_comprobante: \'A\',
            punto_venta: 1,
            concepto: 1,
            doc_tipo: 80,
            doc_nro: \'30712345678\',
            fecha: new Date().toISOString().split(\'T\')[0],
            imp_total: 1000.00,
            imp_neto: 826.45,
            imp_iva: 173.55
        });

        console.log(\'Factura creada con CAE:\', factura.cae);
    } catch (error) {
        console.error(\'Error:\', error.message);
    }
}'
    ],
    'nodejs' => [
        'code' => '// Ejemplo con Node.js
const { FiscalApi } = require(\'@fiscal-api/node\');

const client = new FiscalApi({
    apiKey: \'TU_API_KEY\',
    environment: \'production\'
});

async function crearFactura() {
    try {
        const factura = await client.comprobantes.crear({
            tipo_comprobante: \'A\',
            punto_venta: 1,
            concepto: 1,
            doc_tipo: 80,
            doc_nro: \'30712345678\',
            fecha: new Date().toISOString().split(\'T\')[0],
            imp_total: 1000.00,
            imp_neto: 826.45,
            imp_iva: 173.55
        });

        console.log(\'Factura creada con CAE:\', factura.cae);
    } catch (error) {
        console.error(\'Error:\', error.message);
    }
}'
    ]
];

// Obtener el lenguaje del parámetro GET
$language = isset($_GET['language']) ? strtolower($_GET['language']) : '';

// Validar que el lenguaje exista en nuestro array
if (array_key_exists($language, $codeExamples)) {
    echo json_encode($codeExamples[$language]);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Lenguaje no encontrado']);
} 