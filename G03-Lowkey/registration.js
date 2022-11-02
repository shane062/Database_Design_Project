const form = document.getElementById('form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const email = document.getElementById('email');
const mobile = document.getElementById('phonenumber');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const container = document.getElementById('container');
const after = document.getElementById('after');

form.addEventListener('submit',(e) => {
    e.preventDefault();

	checkInputs();
	
});

	function checkInputs() {
	const fnameValue = fname.value.trim();
	const lnameValue = lname.value.trim();
	const emailValue = email.value.trim();
	const phoneValue = phonenumber.value.trim();
	const passwordValue = password.value;
	const password2Value = password2.value;

	let small = document.querySelector('small');
	let box = document.querySelector('input');
	let number = /^[0-9]*/
	let namevalid = /^[A-Z]+[a-z]*$/
	let emailvalid =  /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	let phonevalid = /(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/
	let passwordvalid = /^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=(.*\d){6})(?!.* )/

	if (fnameValue === '') {
		setErrorFor(fname,'*First Name cannot be blank!*');	
	} else {
			setSuccessFor(fname);
		}

	if (lnameValue === '') {
		setErrorFor(lname,'*Last Name cannot be Blank!*');	
	}else {
			setSuccessFor(lname);
		}

		if (emailValue.match(emailvalid)) {
			setSuccessFor(email);
	}else {
			setErrorFor(email,'*Please Enter a proper Email!*')
		}

		if (phoneValue.match(phonevalid)) {
				setSuccessFor(phonenumber);
		}else {
				setErrorFor(phonenumber,'*Please Enter a proper Mobile Number!*')
			}

	 if (fnameValue.match(number)) {
			setErrorFor(fname,'*First Name cannot be Numbers!*');	
		}else {
				setSuccessFor(fname);
				
			}

	 if (lnameValue.match(number)) {
		setErrorFor(lname,'*Last Name cannot be Numbers!*');	
	}else {
			setSuccessFor(lname);
			
		}
		
	if (fnameValue.match(namevalid)) {
			setSuccessFor(fname);
	} else {
			setErrorFor(fname,'*First Character Uppercase and Follow by Lowercase!*');	
		}

	if (lnameValue.match(namevalid)) {
			setSuccessFor(lname);
	} else {
			setErrorFor(lname,'*First Character Uppercase and Follow by Lowercase!*');	
		}

	if (passwordValue.match(passwordvalid)) {
			setSuccessFor(password);
	} else {
			setErrorFor(password,'*Password must ontain ONE upppercase, ONE lowercase,\nONE special character, numbers and no space!*'); 
		}

	if (password2Value.match(passwordValue)&&password2Value.match(passwordvalid)) {
			setSuccessFor(password2);
	} else {
			setErrorFor(password2,'*Invalid Confirm Password!*'); 
		}

	if (lnameValue.match(namevalid)&&fnameValue.match(namevalid)&&emailValue.match(emailvalid)&&phoneValue.match(phonevalid)&&passwordValue.match(passwordvalid)&&password2Value.match(passwordValue)) 
	{
		container.style.visibility = "hidden";
		after.style.visibility = "visible";
	}

	function setErrorFor(input,message){
		const formControl = input.parentElement;		
		const small = formControl.querySelector('small');
		small.innerText = message;
		formControl.className = 'innerform error';
		}


	function setSuccessFor(input) {
		const formControl = input.parentElement;
		formControl.className = 'innerform success';
		}

}
