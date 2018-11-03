<html>
    <head>
        <title>.: Titulo do Site :.</title>
        <link href="<?php echo BASE_URL; ?>/assets/css/style.css" rel="stylesheet"/>
    </head>
    <body>
        <h2>Topo do Site MVC Padrão</h2>
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        <h1>Rodapé do Site MVC Padrão</h1>
    </body>
</html>