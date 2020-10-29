let getById = x => document.getElementById(x);
let getByName = x => document.getElementsByName(x);
let getBySelector = s => document.querySelector(s);

const handleSubmit = chatPanelElt => {
    
  let user_auth_id = chatPanelElt.dataset.userAuth;
  let user_with_id = chatPanelElt.dataset.userWith;
  let contentMsgElt = getByName("content")[0];

  const data = {
    user_auth_id,
    user_with_id,
    contentMsgElt: contentMsgElt.value
  };


  return new Promise((resolve, reject) => {
    $.ajax({
      url: `/message/with/${user_with_id}`,
      type: "POST",
      data: data,
      dataType: "json",
      success: function (data) {
        resolve(data);
      },
      error: function (error) {
        reject(error);
      }
    });
  });
};

const handleTemplating = message => {
  const template = getBySelector("#user-message-template").innerHTML;
  const html = Mustache.render(template, message);

  console.log(html);
  getBySelector("#chat-panel-message").innerHTML += html;
};

(function () {
  let chatPanelElt = getById("chat-panel-message");
  let formBtnElt = getById("format-chat-btn");

  formBtnElt.addEventListener("click", e => {
    e.preventDefault();
    handleSubmit(chatPanelElt)
      .then(data => {
        console.log(data);
        handleTemplating(data);
      })
      .catch(() => {
        alert("ajax req no ok");
      });
  });


})();
