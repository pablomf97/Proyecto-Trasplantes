	function passwordValidation(){
		var password = document.getElementById("pass");
		var pwd = password.value;
		var valid = true;

		// Comprobamos la longitud de la contraseña
		valid = valid && (pwd.length>=8);
		
		// Comprobamos si contiene letras mayúsculas, minúsculas y números
		var hasNumber = /\d/;
		var hasUpperCases = /[A-Z]/;
		var hasLowerCases = /[a-z]/;
		valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
		
		// Si no cumple las restricciones, devolvemos un error
		if(!valid){
			var error = "Por favor, ingresa una contraseña con 8 caracteres, que tenga al menos una mayúsucula, una minúscula y un dígito.";
		}else{
			var error = "";
		}
	        password.setCustomValidity(error);
		return error;
	}

	// EJERCICIO 2: Calcula la fortaleza de una contraseña: frecuencia de repetición de caracteres
	function passwordStrength(password){
    		// Creamos un Map donde almacenar las ocurrencias de cada carácter
    		var letters = {};

    		// Recorremos la contraseña carácter por carácter
    		var length = password.length;
    		for(x = 0, length; x < length; x++) {
        		// Consultamos el carácter en la posición x
        		var l = password.charAt(x);

        		// Si NO existe en el Map, inicializamos su contador a uno
        		// Si ya existía, incrementamos el contador en uno
        		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    		}

    		// Devolvemos el cociente entre el número de caracteres únicos (las claves del Map)
		// y la longitud de la contraseña
    		return Object.keys(letters).length / length;
	}
	
	// EJERCICIO 4: Coloreado del campo de contraseña según su fortaleza
	function passwordColor(){
		var passField = document.getElementById("pass");
		var strength = passwordStrength(passField.value);
		
		if(!isNaN(strength)){
			var type = "rojopass";
			if(passwordValidation()!=""){
				type = "rojopass";
			}else if(strength > 0.7){
				type = "fuertepass";
			}else if(strength > 0.4){
				type = "mediopass";
			}
		}else{
			type = "nopass";
		}
		passField.className = type;
		
		return type;
	}
