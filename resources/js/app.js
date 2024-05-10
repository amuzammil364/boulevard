import "./bootstrap";
import "flowbite";



document.addEventListener('DOMContentLoaded',()=>{

    autoFillMaintenanceAmount();

});


let autoFillMaintenanceAmount = ()=>{

    let global_maintenance_amount_field = document.getElementById('global_maintenance_amount');
    if(global_maintenance_amount_field){
        let type = document.getElementById('type');
        type.addEventListener('change',(e)=>{
            let amount_field = document.getElementById('amount');
            if(e.target.value=='Maintenance'){
                amount_field.value = global_maintenance_amount_field.value;
            }else{
                amount_field.value = "";
            }
        })
    }

}
