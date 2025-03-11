<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Verificar si se recibió el parámetro language
if (!isset($_GET['language'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Parámetro language no especificado']);
    exit;
}

// Obtener el lenguaje solicitado
$language = $_GET['language'];

// Array con los ejemplos de código
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

// Verificar si el lenguaje existe
if (!array_key_exists($language, $codeExamples)) {
    http_response_code(404);
    echo json_encode(['error' => 'Lenguaje no encontrado']);
    exit;
}

// Devolver el contenido del código
echo json_encode($codeExamples[$language]); 