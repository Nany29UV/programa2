<!DOCTYPE html> 
<html> 
<head> 
    <title>Tarjetas de datos</title> 
</head> 
<body align="center"> 
    <form method="post"> 
        <label for="cantidad">INGRESE LA CANTIDAD DE TARJETAS: </label> 
        <input type="number" name="cantidad" id="cantidad" min='1' required><br><br> 
        <label> Al momento que quiera darle a calcular, debe colocar la cantidad de tarjeta de nuevo aqui. </label><br><br>
        <input type='submit' name='siguiente' value='Siguiente'>

        

        <?php 
        if(isset($_POST['siguiente'])){ 
            $cantidad = $_POST['cantidad']; 
            for($i=1; $i<=$cantidad; $i++){ 
                echo "<h3>TARJETA $i</h3>"; 
                echo "<label for='cedula$i'>Número de cédula de identidad del alumno: </label>"; 
                echo "<input type='text' name='cedula$i' id='cedula$i' pattern='[0-9]+' minlength='7' maxlength='10' required><br><br>";

                echo "<label for='nombre$i'>Nombre del alumno: </label>"; 
                echo "<input type='text' name='nombre$i' id='nombre$i' pattern='[A-Za-z]+'' required><br><br>"; 

                echo "<label for='matematicas$i'>Nota de matemáticas: </label>"; 
                echo "<input type='number' name='matematicas$i' id='matematicas$i' min='1' max='20' required><br><br>"; 

                echo "<label for='fisica$i'>Nota de física: </label>"; 
                echo "<input type='number' name='fisica$i' id='fisica$i' min='1' max='20' required><br><br>"; 

                echo "<label for='programacion$i'>Nota de programación: </label>"; 
                echo "<input type='number' name='programacion$i' id='programacion$i' min='1' max='20' required><br><br>"; 
            } 
            echo "<input type='submit' name='calcular' value='Calcular'>"; 
            echo "<input type='reset' name='limpiar' value='Limpiar'>"; 
        } 
        ?> 
    </form> 
 
    <?php 
    if(isset($_POST['calcular'])){ 
        $cantidad = $_POST['cantidad']; 
        $materias = ['matematicas', 'fisica', 'programacion']; 
        $notas = []; 
        for($i=1; $i<=$cantidad; $i++){ 
            $nota_mate = $_POST['matematicas'.$i]; 
            $nota_fisica = $_POST['fisica'.$i]; 
            $nota_prog = $_POST['programacion'.$i]; 
            $notas[] = [ 
                'matematicas' => $nota_mate, 
                'fisica' => $nota_fisica, 
                'programacion' => $nota_prog 
            ]; 
        } 
 
        $promedios = []; 
        foreach($materias as $materia){ 
            $suma = 0; 
            foreach($notas as $nota){ 
                $suma += $nota[$materia]; 
            } 
            $promedio = $suma / $cantidad; 
            $promedios[$materia] = $promedio; 
        } 
 
        $aprobados = []; 
        foreach($materias as $materia){ 
            $aprobados[$materia] = 0; 
            foreach($notas as $nota){ 
                if($nota[$materia] >= 10){ 
                    $aprobados[$materia]++; 
                } 
            } 
        } 
 
        $aplazados = []; 
        foreach($materias as $materia){ 
            $aplazados[$materia] = 0; 
            foreach($notas as $nota){ 
                if($nota[$materia] < 10){ 
                    $aplazados[$materia]++; 
                } 
            } 
        } 
 
        $aprobados_todas = 0; 
        foreach($notas as $nota){ 
            $aprobado = true; 
            foreach($materias as $materia){ 
                if($nota[$materia] < 10){ 
                    $aprobado = false; 
                    break; 
                } 
            } 
            if($aprobado){ 
                $aprobados_todas++; 
            } 
        } 
 
        $aprobados_una = 0; 
        foreach($notas as $nota){ 
            $aprobadas = 0; 
            foreach($materias as $materia){ 
                if($nota[$materia] >= 10){ 
                    $aprobadas++; 
                } 
            } 
            if($aprobadas == 1){ 
                $aprobados_una++; 
            } 
        } 
 
        $aprobados_dos = 0;

        foreach($notas as $nota){ 
            $aprobadas = 0; 
            foreach($materias as $materia){ 
                if($nota[$materia] >= 10){ 
                    $aprobadas++; 
                } 
            } 
            if($aprobadas == 2){ 
                $aprobados_dos++; 
            } 
        } 
 
        $maximas = []; 
        foreach($materias as $materia){ 
            $maxima = 0; 
            foreach($notas as $nota){ 
                if($nota[$materia] > $maxima){ 
                    $maxima = $nota[$materia]; 
                } 
            } 
            $maximas[$materia] = $maxima; 
        } 
 
        echo "<h1>RESULTADOS:</h1>"; 
        echo "<h3>Promedio de cada materia:</h3>"; 
        foreach($promedios as $materia => $promedio){ 
            echo "$materia: $promedio<br>"; 
        } 
        echo "<h3>Alumnos aprobados en cada materia:</h3>"; 
        foreach($aprobados as $materia => $cantidad){ 
            echo "$materia: $cantidad<br>"; 
        } 
        echo "<h3>Alumnos aplazados en cada materia:</h3>"; 
        foreach($aplazados as $materia => $cantidad){ 
            echo "$materia: $cantidad<br>"; 
        } 
        echo "<h3>Alumnos que aprobaron todas las materias:</h3>"; 
        echo $aprobados_todas."<br>"; 

        echo "<h3>Alumnos que aprobaron una sola materia:</h3>"; 
        echo $aprobados_una."<br>"; 

        echo "<h3>Alumnos que aprobaron dos materias:</h3>"; 
        echo $aprobados_dos."<br>"; 

        echo "<h3>Nota máxima en cada materia:</h3>"; 
        foreach($maximas as $materia => $maxima){ 
            echo "$materia: $maxima<br>"; 
        } 
    } 
    ?> 
</body> 
</html>