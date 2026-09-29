<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración - Información de la Fundación</title>
    <!-- Usamos FontAwesome para iconos limpios -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            color: #333;
            padding: 30px;
        }
        .admin-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .admin-header {
            background: #2c3e50;
            color: #fff;
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-header h1 {
            font-size: 20px;
            font-weight: 500;
        }
        .admin-header h1 i {
            margin-right: 10px;
            color: #3498db;
        }
        .admin-body {
            padding: 30px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #dcdde1;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.2);
        }
        textarea.form-control {
            resize: vertical;
            height: 120px;
        }
        .preview-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border: 1px dashed #dcdde1;
            margin-top: 8px;
        }
        .preview-box img {
            max-height: 60px;
            width: auto;
            background: #fff;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-container {
            margin-top: 30px;
            text-align: right;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .btn-guardar {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-guardar:hover {
            background-color: #219653;
        }
        .btn-guardar i {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fa-solid fa-building-shield"></i> Configuración General de la Fundación</h1>
        </div>
        
        <div class="admin-body">
            <!-- Ejemplo de alerta cuando se guarden los datos -->
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> Los cambios se han guardado correctamente en la página web.
            </div>

            <!-- Formulario conectado a tu base de datos -->
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="titulo">Título Principal de la Fundación:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="Fundación Sanax" required>
                </div>

                <div class="form-group">
                    <label for="eslogan">Eslogan o Frase Destacada:</label>
                    <input type="text" id="eslogan" name="eslogan" class="form-control" value="Construyendo un futuro con esperanza y salud">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción / Resumen:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control">Somos una organización comprometida con brindar apoyo social, comunitario y de salud a los sectores más vulnerables de la ciudad.</textarea>
                </div>

                <div class="form-group">
                    <label>Logotipo Actual:</label>
                    <div class="preview-box">
                        <!-- Aquí se muestra la imagen que viene de tu BD -->
                        <img src="imagenes/logoFundaciónPNG.png" alt="Logo actual">
                        <div>
                            <p style="font-size: 13px; color: #666; margin-bottom: 5px;">Selecciona un nuevo archivo si deseas reemplazar el logo:</p>
                            <input type="file" name="logo" class="form-control" style="border: none; padding: 0;">
                        </div>
                    </div>
                </div>

                <div class="btn-container">
                    <button type="submit" name="actualizar_fundacion" class="btn-guardar">
                        <i class="fa-solid fa-floppy-disk"></i> Guardar Cambios
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>