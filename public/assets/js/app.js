
let getById = (x) => document.getElementById(x);
let getByName =(x)=> document.getElementsByName(x);
let getBySelector = s => document.querySelector(s);


const handleSubmit = (event, chatPanelElt) => {

    event.preventDefault();
    let user_auth_id = chatPanelElt.dataset.userAuth;
    let user_with_id = chatPanelElt.dataset.userWith;
    let contentMsgElt = getByName('content')[0];

    const data = {
        user_auth_id,
        user_with_id,
        contentMsgElt: contentMsgElt.value,
    }
    //console.log(JSON.stringify(data))

    $.ajax({
        url : `/message/with/${user_with_id}`,
        type : 'POST',
        data : data,
        dataType: 'json'
    });


}



const handleTemplating = ()=>{

    const message = {
      position: "right",
      profile: "user_2",
      displayName: "Yann deo",
      content: "Please God"
    };

    const template = getBySelector("#user-message-template").innerHTML;
    const html = Mustache.render(template, message);

    console.log(html)
    getBySelector("#chat-panel-message").innerHTML += html;
}

(function (){

    let chatPanelElt = getById('chat-panel-message');
    let formBtnElt = getById('format-chat-btn');

    formBtnElt.addEventListener('click', (e)=>{
        handleSubmit(e, chatPanelElt);
        handleTemplating();
    })


}())