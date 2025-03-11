<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Array asociativo con los ejemplos de código por lenguaje
$codeExamples = [
    'php' => [
        'code' => '<span class="comment">// Ejemplo de integración con PHP</span>
<span class="variable">$client</span> = <span class="keyword">new</span> <span class="class">FiscalApiClient</span>([
    <span class="string">\'api_key\'</span> => <span class="string">\'TU_API_KEY\'</span>,
    <span class="string">\'environment\'</span> => <span class="string">\'production\'</span>
]);

<span class="keyword">try</span> {
    <span class="variable">$factura</span> = <span class="variable">$client</span>->comprobantes->crear([
        <span class="string">\'tipo_comprobante\'</span> => <span class="string">\'A\'</span>,
        <span class="string">\'punto_venta\'</span> => <span class="number">1</span>,
        <span class="string">\'concepto\'</span> => <span class="number">1</span>,
        <span class="string">\'doc_tipo\'</span> => <span class="number">80</span>,
        <span class="string">\'doc_nro\'</span> => <span class="string">\'30712345678\'</span>,
        <span class="string">\'fecha\'</span> => <span class="function">date</span>(<span class="string">\'Y-m-d\'</span>),
        <span class="string">\'imp_total\'</span> => <span class="number">1000.00</span>,
        <span class="string">\'imp_neto\'</span> => <span class="number">826.45</span>,
        <span class="string">\'imp_iva\'</span> => <span class="number">173.55</span>
    ]);

    <span class="function">echo</span> <span class="string">"Factura creada con CAE: "</span> . <span class="variable">$factura</span>->cae;
} <span class="keyword">catch</span> (<span class="class">FiscalApiException</span> <span class="variable">$e</span>) {
    <span class="function">echo</span> <span class="string">"Error: "</span> . <span class="variable">$e</span>->getMessage();
}'
    ],
    'javascript' => [
        'code' => '<span class="comment">// Ejemplo con JavaScript</span>
<span class="keyword">const</span> <span class="variable">fiscalApi</span> = <span class="keyword">new</span> <span class="class">FiscalApi</span>(<span class="string">\'TU_API_KEY\'</span>);

<span class="keyword">async</span> <span class="function">function</span> <span class="function">crearFactura</span>() {
    <span class="keyword">try</span> {
        <span class="keyword">const</span> <span class="variable">factura</span> = <span class="keyword">await</span> <span class="variable">fiscalApi</span>.comprobantes.crear({
            <span class="variable">tipo_comprobante</span>: <span class="string">\'A\'</span>,
            <span class="variable">punto_venta</span>: <span class="number">1</span>,
            <span class="variable">concepto</span>: <span class="number">1</span>,
            <span class="variable">doc_tipo</span>: <span class="number">80</span>,
            <span class="variable">doc_nro</span>: <span class="string">\'30712345678\'</span>,
            <span class="variable">fecha</span>: <span class="keyword">new</span> <span class="class">Date</span>().toISOString().split(<span class="string">\'T\'</span>)[<span class="number">0</span>],
            <span class="variable">imp_total</span>: <span class="number">1000.00</span>,
            <span class="variable">imp_neto</span>: <span class="number">826.45</span>,
            <span class="variable">imp_iva</span>: <span class="number">173.55</span>
        });

        <span class="function">console</span>.log(<span class="string">\'Factura creada con CAE:\'</span>, <span class="variable">factura</span>.cae);
    } <span class="keyword">catch</span> (<span class="variable">error</span>) {
        <span class="function">console</span>.error(<span class="string">\'Error:\'</span>, <span class="variable">error</span>.message);
    }
}'
    ],
    'nodejs' => [
        'code' => '<span class="comment">// Ejemplo con Node.js</span>
<span class="keyword">const</span> { <span class="class">FiscalApi</span> } = <span class="function">require</span>(<span class="string">\'@fiscal-api/node\'</span>);

<span class="keyword">const</span> <span class="variable">client</span> = <span class="keyword">new</span> <span class="class">FiscalApi</span>({
    <span class="variable">apiKey</span>: <span class="string">\'TU_API_KEY\'</span>,
    <span class="variable">environment</span>: <span class="string">\'production\'</span>
});

<span class="keyword">async</span> <span class="function">function</span> <span class="function">crearFactura</span>() {
    <span class="keyword">try</span> {
        <span class="keyword">const</span> <span class="variable">factura</span> = <span class="keyword">await</span> <span class="variable">client</span>.comprobantes.crear({
            <span class="variable">tipo_comprobante</span>: <span class="string">\'A\'</span>,
            <span class="variable">punto_venta</span>: <span class="number">1</span>,
            <span class="variable">concepto</span>: <span class="number">1</span>,
            <span class="variable">doc_tipo</span>: <span class="number">80</span>,
            <span class="variable">doc_nro</span>: <span class="string">\'30712345678\'</span>,
            <span class="variable">fecha</span>: <span class="keyword">new</span> <span class="class">Date</span>().toISOString().split(<span class="string">\'T\'</span>)[<span class="number">0</span>],
            <span class="variable">imp_total</span>: <span class="number">1000.00</span>,
            <span class="variable">imp_neto</span>: <span class="number">826.45</span>,
            <span class="variable">imp_iva</span>: <span class="number">173.55</span>
        });

        <span class="function">console</span>.log(<span class="string">\'Factura creada con CAE:\'</span>, <span class="variable">factura</span>.cae);
    } <span class="keyword">catch</span> (<span class="variable">error</span>) {
        <span class="function">console</span>.error(<span class="string">\'Error:\'</span>, <span class="variable">error</span>.message);
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