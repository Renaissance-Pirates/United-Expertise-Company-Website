const API_Endpoint = `${window.location.origin}/wp-json/uec-theme/api`;

const Reload_Blogs = async (Language) =>
{
    const Response = await fetch (`${API_Endpoint}/blogs?language=${Language === 'en' ? 'ar' : 'en'}`);
	const Response_Body = await Response.text ();
	document.getElementsByClassName ('Blog_Cards') [0].innerHTML = Response_Body !== '' ? Response_Body : Language == 'en' ? 'لا توجد مدونات لعرضها' : 'There are no blogs to display';
}

const Send_Email = async (Language) =>
{
	const Response = await fetch (`${API_Endpoint}/email`, { method: 'POST',  headers: { 'Content-Type': 'application/json' }, body: JSON.stringify ({ Name: document.getElementsByClassName ('Input_Field') [0].value, Email: document.getElementsByClassName ('Input_Field') [1].value, Subject: Language === 'ar' ? `${document.querySelector ('.Selection_Controller:checked').value} طلب` : `Request for ${document.querySelector ('.Selection_Controller:checked').value}`, Message: document.getElementsByClassName ('Input_Field') [2].value, Language })});
	const Response_Body = await Response.json ();
	document.getElementsByClassName ('Contact_Us_Response') [0].classList.remove ('Display_None');
	if (Response_Body.Status === 201)
	{
		document.getElementById ('Contact_Us_Header').classList.add ('Display_None');
		document.getElementsByClassName ('Contact_Us_Form') [0].classList.add ('Display_None');
		document.getElementById ('Call_to_Action_2').classList.add ('Display_None');
		if ([...document.getElementById ('Email_Icon').classList].includes ('Display_None'))
		{
			document.getElementById ('Email_Icon').classList.remove ('Display_None');
		}
	}
	else
	{
		document.getElementById ('Email_Icon').classList.add ('Display_None');
	}
	document.getElementById ('Email_Response').innerHTML = Response_Body.Message;

}