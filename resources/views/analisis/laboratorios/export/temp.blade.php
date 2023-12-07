<table>
    <thead>
        <tr>
            <th>INGRESO</th>
            <th>CÓDIGO</th>
            <th>APELLIDOS</th>
            <th>NOMBRES</th>
            <th>SEXO</th>
            <th>EDAD</th>
            <th>DPTOS</th>
            <th>LOCALIDAD</th>
            <th>DIRECCIÓN</th>
            <th>TÉLEFONO</th>
            <th>HOSPITALIZADO</th>
            <th>CENTRO NOTIFICADOR</th>
            <th>F. INICIO</th>
            <th>SEM-EPID</th>
            <th>F. TOMA</th>
            <th>DÍAS</th>
            <th>RESULTADO   RT-PCR   EN TIEMPO REAL</th>
            <th>OBSERVACIONES</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($casos as $caso)
                <tr>
                    <td>{{$caso->fecha_ingreso}}</td>
                    <td>{{$caso->id}}</td>
                    <td>{{$caso->ap_paterno}}</td>
                    <td>{{$caso->name}}</td>
                    <td>{{$caso->genero}}</td>
                    <td>{{$caso->edad}}</td>
                    <td>{{$caso->departamento}}</td>
                    <td>{{$caso->localidad}}</td>
                    <td>{{$caso->barrio}}</td>
                    <td>{{$caso->telefono}}</td>
                    <td>{{$caso->hospitalizado}}</td>
                    <td>{{$caso->punto_atencion}}</td> 
                    <td>{{$caso->fecha_ini}}</td>
                    <td>{{$caso->sem}}</td>
                    <td>{{$caso->fecha_toma}}</td> 
                    <td>{{$caso->dias}}</td>
                    <td>{{$caso->resultados}}</td>
                    <td>{{$caso->observaciones}}</td> 

                </tr>
            @endforeach
    </tbody>
</table>