function AdministrarValidaciones():boolean
{
    const dni : number = Number((<HTMLInputElement>document.getElementById('txtDni')).value);
    const legajo : number = Number((<HTMLInputElement>document.getElementById('txtLegajo')).value);
    const sueldo : number = Number((<HTMLInputElement>document.getElementById('txtSueldo')).value);
    const apellido : string = ((<HTMLInputElement>document.getElementById('txtApellido')).value);
    const nombre : string = ((<HTMLInputElement>document.getElementById('txtNombre')).value);
    const sexo : string = ((<HTMLInputElement>document.getElementById('cboSexo')).value);
    
    AdministrarSpanError('txtApellido', !ValidarCamposVacios(apellido));
    AdministrarSpanError('txtNombre', !ValidarCamposVacios(nombre));
    AdministrarSpanError('txtLegajo', !ValidarCamposVacios(legajo.toString()));
    AdministrarSpanError('txtDni', !ValidarCamposVacios(dni.toString()));
    AdministrarSpanError('txtSueldo', !ValidarCamposVacios(sueldo.toString()));
    AdministrarSpanError('cboSexo', !ValidarCamposVacios(sexo.toString()));
    AdministrarSpanError('txtDni', !ValidarRangoNumerico(1000000, 55000000,dni));
    AdministrarSpanError('cboSexo', !ValidarCombo(sexo));
    AdministrarSpanError('txtLegajo', !ValidarRangoNumerico(100, 550, legajo));
    AdministrarSpanError('txtSueldo', !ValidarRangoNumerico(8000, ObtenerSueldoMaximo(ObtenerTurnoSeleccionado()),sueldo));

    return VerificarValidacionesLogin();
}

function AdministrarValidacionesLogin()
{
    const dni : number = Number((<HTMLInputElement>document.getElementById('txtDni')).value);
    const apellido : string = ((<HTMLInputElement>document.getElementById('txtApellido')).value);
    AdministrarSpanError('txtDni', !ValidarCamposVacios(dni.toString()));
    AdministrarSpanError('txtDni', !ValidarRangoNumerico(1000000, 55000000,dni));
    AdministrarSpanError('txtApellido', !ValidarCamposVacios(apellido));

    return VerificarValidacionesLogin();
}

function ValidarCamposVacios(campo : string) : boolean
{
    const result = campo != '' ? true : false;

    return result;
}

function ValidarRangoNumerico(min : number, max : number,num : number) : boolean
{
    const result = num >= min && num<=max ? true : false;

    return result;
}

function ValidarCombo(sexo : string, defecto = 'default') : boolean
{
    const result = sexo != defecto ? true : false;

    return result;
}

function ObtenerTurnoSeleccionado() : string
{
    if((<HTMLInputElement>document.getElementById('tManana')).checked)
    {
        return 'Manana';
    }    
    else
    {
        if((<HTMLInputElement>document.getElementById('tTarde')).checked)
        {
            return 'Tarde';
        }
        else((<HTMLInputElement>document.getElementById('tNoche')).checked)
        {
            return 'Noche';
        }
    }
}

function ObtenerSueldoMaximo(turno:string) : number
{
    switch(turno)
    {
        case 'Manana':
            return 20000;
        case 'Tarde':
            return 18500;
        case 'Noche':
            return 25000;
    }
    return 0;
}

function AdministrarSpanError(unId : string, bandera : boolean) : void
{
    if(bandera)
    {
        (<HTMLElement>(<HTMLElement>document.getElementById(unId)).nextElementSibling).style.display = 'block';
    }
    else
    {
        (<HTMLElement>(<HTMLElement>document.getElementById(unId)).nextElementSibling).style.display = 'none';
    }
}

function VerificarValidacionesLogin() : boolean {
    let boolRetorno = true;
    let todoSpan : NodeList = document.querySelectorAll('span');

    for(let i = 0; i < todoSpan.length; i++) {
        if((<HTMLSpanElement>todoSpan[i]).style.display=='block') {
            boolRetorno=false;
            break;
        }
    }

    return boolRetorno;
}