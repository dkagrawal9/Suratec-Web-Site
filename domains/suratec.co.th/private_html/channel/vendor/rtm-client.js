// import EventEmitter from 'events';
/*!
 * EventEmitter v4.1.0 - git.io/ee
 * Oliver Caldwell
 * MIT license
 * @preserve
 */
!function(r){"use strict";function t(){}function n(n,e){if(i)return e.indexOf(n);for(var t=e.length;t--;)if(e[t]===n)return t;return-1}var e=t.prototype,i=Array.prototype.indexOf?!0:!1;e._getEvents=function(){return this._events||(this._events={})},e.getListeners=function(n){var r,e,t=this._getEvents();if("object"==typeof n){r={};for(e in t)t.hasOwnProperty(e)&&n.test(e)&&(r[e]=t[e])}else r=t[n]||(t[n]=[]);return r},e.getListenersAsObject=function(n){var e,t=this.getListeners(n);return t instanceof Array&&(e={},e[n]=t),e||t},e.addListener=function(i,r){var e,t=this.getListenersAsObject(i);for(e in t)t.hasOwnProperty(e)&&-1===n(r,t[e])&&t[e].push(r);return this},e.on=e.addListener,e.defineEvent=function(e){return this.getListeners(e),this},e.defineEvents=function(t){for(var e=0;e<t.length;e+=1)this.defineEvent(t[e]);return this},e.removeListener=function(i,s){var r,e,t=this.getListenersAsObject(i);for(e in t)t.hasOwnProperty(e)&&(r=n(s,t[e]),-1!==r&&t[e].splice(r,1));return this},e.off=e.removeListener,e.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},e.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},e.manipulateListeners=function(r,t,i){var e,n,s=r?this.removeListener:this.addListener,o=r?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(e=i.length;e--;)s.call(this,t,i[e]);else for(e in t)t.hasOwnProperty(e)&&(n=t[e])&&("function"==typeof n?s.call(this,e,n):o.call(this,e,n));return this},e.removeEvent=function(n){var e,r=typeof n,t=this._getEvents();if("string"===r)delete t[n];else if("object"===r)for(e in t)t.hasOwnProperty(e)&&n.test(e)&&delete t[e];else delete this._events;return this},e.emitEvent=function(r,i){var n,e,s,t=this.getListenersAsObject(r);for(e in t)if(t.hasOwnProperty(e))for(n=t[e].length;n--;)s=i?t[e][n].apply(null,i):t[e][n](),s===!0&&this.removeListener(r,t[e][n]);return this},e.trigger=e.emitEvent,e.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},"function"==typeof define&&define.amd?define(function(){return t}):r.EventEmitter=t}(this);

function Toastify (options) {
  M.toast({html: options.text, classes: options.classes})
}

var Toast = {
  info: (msg) => {
    Toastify({
      text: msg,
      classes: "info-toast"
    })
  },
  notice: (msg) => {
    Toastify({
      text: msg,
      classes: "notice-toast"
    })
  },
  error: (msg) => {
    Toastify({
      text: msg,
      classes: "error-toast"
    })
  }
}

class RtmClient extends EventEmitter  {
  constructor() {
    super();
    this.channels = {};
    this._logined = false;
  }

  init(appId) {
    this.client = AgoraRTM.createInstance(appId);
    this.subscribeClientEvents();
  }

  // subscribe client events
  subscribeClientEvents() {
    const clientEvents = [
      "ConnectionStateChanged",
      "MessageFromPeer",
    ];
    clientEvents.forEach((eventName) => {
      this.client.on(eventName, (...args) => {
        console.log("emit ", eventName, ...args);
        // log event message
        this.emit(eventName, ...args);
      });
    });
  }

  // subscribe channel events
  subscribeChannelEvents(channelName) {
    const channelEvents = [
      "ChannelMessage",
      "MemberJoined",
      "MemberLeft"
    ];
    channelEvents.forEach((eventName) => {
      this.channels[channelName].channel.on(eventName, (...args) => {
        console.log("emit ", eventName, args);
        this.emit(eventName, {channelName, args: args});
      });
    });
  }

  async login(accountName, token) {
    this.accountName = accountName;
    return this.client.login({uid: this.accountName, token});
  }

  async logout() {
    return this.client.logout();
  }

  async joinChannel(name) {
    console.log("joinChannel", name)
    const channel = this.client.createChannel(name);
    this.channels[name] = {
      channel,
      joined: false // channel state
    }
    this.subscribeChannelEvents(name)
    return channel.join();
  }

  async leaveChannel(name) {
    console.log("leaveChannel", name);
    if (!this.channels[name] ||
      (this.channels[name]
        && !this.channels[name].joined)) return;
    if (this.channels[name].channel.leave()) {
      return true;
    }else{
      return false;
    }
  }

  async sendChannelMessage(text, channelName) {
  console.log("sendChannelMessage", text, channelName);
    if (!this.channels[channelName] || !this.channels[channelName].joined) return;
    return this.channels[channelName].channel.sendMessage({text});
  }

  async sendPeerMessage(text, peerId) {
    console.log("sendPeerMessage", text, peerId);
    return this.client.sendMessageToPeer({text}, peerId.toString());
  }

  async queryPeersOnlineStatus(memberId) {
    console.log("queryPeersOnlineStatus", memberId);
    return this.client.queryPeersOnlineStatus([memberId]);
  }
}

let rtm = new RtmClient();
let memberOnline = false;

$(() => {
  M.AutoInit();

  rtm.on("ConnectionStateChanged", (newState, reason) => {
    console.log("reason", reason);
    const view = $("<div/>",{
      text: ["newState: " + newState, ", reason: ", reason].join(""),
    })
    $("#log").append(view)
    if (newState == "ABORTED") {
      if (reason == "REMOTE_LOGIN") {
        console.log("You have already been kicked off!");
        // Toast.error("You have already been kicked off!");
        $("#accountName").text('Agora Chatroom');

        rtm.clearState();
        $("#dialogue-list")[0].innerHTML = '';
        $("#chat-message")[0].innerHTML = '';
      }
    }
  })

  rtm.on("MessageFromPeer", (message, peerId) => {
    console.log("message "+ message.text + " peerId" + peerId);
    const view = $("<div/>",{
      text: ["message.text: " + message.text, ", peer: ", peerId].join(""),
    })
    $("#log").append(view)
  });

  rtm.on("MemberJoined", ({channelName, args}) => {
    const memberId = args[0];
    console.log("channel ", channelName, " member: ", memberId, " joined");
    memberOnline = true;
    Toast.notice(`${receiverName} is online`)
  });

  rtm.on("MemberLeft", ({channelName, args}) => {
    const memberId = args[0];
    console.log("channel ", channelName, " member: ", memberId, " left");
    memberOnline = false;
    Toast.error(`${receiverName} is offline`)
  });

  rtm.on("ChannelMessage", ({channelName, args}) => {
    const [message, memberId] = args;
    // console.log("channel ", channelName, ", messsage: ", message.text, ", memberId: ", memberId);
    let _html = receiverTemplate.replace("{{MESSAGE}}",message.text);
    _html = _html.replace("{{DATE_TIME}}",getFullDate());
    $("#chatLog").append(_html);
    $('#chatLog').scrollTop($('#chatLog')[0].scrollHeight);
  });

  $("#login").on("click", function (e) {
    e.preventDefault();

    if (rtm._logined) {
      console.log("You already logined");
      // Toast.error("You already logined");
      return;
    }

    try {
      rtm.init(appId);
      window.rtm = rtm;
      rtm.login(userName).then(() => {
        console.log('login')
        rtm._logined = true
        console.log("Login: " + userName);
        // Toast.notice("Login: " + params.accountName);
      }).catch((err) => {
        console.log(err)
      })
    } catch(err) {
      console.log("Login failed, please open console see more details");
      // Toast.error("Login failed, please open console see more details");
      console.error(err);
    }
  })

  $("#logout").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      console.log("You already logout");
      // Toast.error("You already logout");
      return;
    }
    rtm.logout().then(() => {
      console.log('logout')
      rtm._logined = false
      console.log("Logout: " + rtm.accountName);
      // Toast.notice("Logout: " + rtm.accountName);
    }).catch((err) => {
      console.log("Logout failed, please open console see more details");
      // Toast.error("Logout failed, please open console see more details");
      console.log(err)
    })
  })

  $("#join").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      console.log("Please Login First");
      // Toast.error("Please Login First");
      return;
    }

    // const params = serializeFormData("loginForm");

    // if (!validator(params, ['appId', 'accountName', 'channelName'])) {
    //   return;
    // }

    if (rtm.channels[channelMD5] ||
        (rtm.channels[channelMD5] && rtm.channels[channelMD5].joined)) {
      console.log("You already joined");
      // Toast.error("You already joined");
      return;
    }

    rtm.joinChannel(channelMD5).then(() => {
      const view = $("<div/>", {
        text: rtm.accountName + " join channel success"
      });
      $("#log").append(view);
      rtm.channels[channelMD5].joined = true;
    }).catch((err) => {
      console.log("Join channel failed, please open console see more details.")
      // Toast.error("Join channel failed, please open console see more details.")
      console.error(err)
    })
  })

  $("#leave").on("click", function (e) {
    e.preventDefault();
    // if (!rtm._logined) {
    //   console.log("Please Login First");
    //   // Toast.error("Please Login First");
    //   return;
    // }

    // const params = serializeFormData("loginForm");

    // if (!validator(params, ['appId', 'accountName', 'channelName'])) {
    //   return;
    // }

    // if (!rtm.channels[channelMD5] || 
    //   (rtm.channels[channelMD5] && !rtm.channels[channelMD5].joined )
    // ) {
    //   console.log("You already leave");
    //   // Toast.error("You already leave");
    // }

    rtm.leaveChannel(channelMD5).then(() => {
      // const view = $("<div/>", {
      //   text: rtm.accountName + " leave channel success"
      // });
      // $("#log").append(view)
      if (rtm.channels[channelMD5]) {
        rtm.channels[channelMD5].joined = false;
        rtm.channels[channelMD5] = null;
      }
      console.log('Left channel');
    }).catch((err) => {
      console.log("Leave channel failed, please open console see more details.")
      // Toast.error("Leave channel failed, please open console see more details.")
      console.error(err)
    })

  })

  $("#send_channel_message").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      console.log("Please Login First");
      // Toast.error("Please Login First");
      return;
    }

    const params = serializeFormData("loginForm");

    if (!validator(params, ['appId', 'accountName', 'channelName', 'channelMessage'])) {
      return;
    }

    if (!rtm.channels[channelMD5] || 
      (rtm.channels[channelMD5] && !rtm.channels[channelMD5].joined )
    ) {
      console.log("Please Join first");
      // Toast.error("Please Join first");
    }

    rtm.sendChannelMessage(params.channelMessage, channelMD5).then(() => {
      const view = $("<div/>", {
        text: "account: " + rtm.accountName + " send : " + params.channelMessage + " channel: " + channelMD5
      });
      $("#log").append(view)
    }).catch((err) => {
      console.log("Send message to channel " + channelMD5 + " failed, please open console see more details.")
      // Toast.error("Send message to channel " + channelMD5 + " failed, please open console see more details.")
      console.error(err)
    })

  })

  $("#messageText").keydown(function (e) { 
    if (e.keyCode == 13) {
      $("#sendMessage").trigger('click');
    }
  });

  $("#sendMessage").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      Toast.error("You are not logged in");
      return;
    }
    if (!rtm.channels[channelMD5] || 
      (rtm.channels[channelMD5] && !rtm.channels[channelMD5].joined )
    ) {
      Toast.error("Please Join first");
    }

    const channelMessage = $("#messageText").val();
    if (channelMessage.trim() !== '') {
      rtm.sendChannelMessage(channelMessage, channelMD5).then(async () => {

        // await rtm.queryPeersOnlineStatus(receiverUID).then((res) => {
        //   memberOnline = true;
        //   console.log(res);
        //   console.log('here online');
        // }).catch((err) => {
        //   memberOnline = false;
        //   console.log('here offline');
        // })

        console.log({memberOnline});

        let _html = senderTemplate.replace("{{MESSAGE}}",channelMessage);
        _html = _html.replace("{{DATE_TIME}}",getFullDate());
        $("#chatLog").append(_html);
        $('#chatLog').scrollTop($('#chatLog')[0].scrollHeight);
        $("#messageText").val("");
        const chatData = {
          channel: channel,
          message: channelMessage,
          user_id: userUID,
          // unread: memberOnline === true ? 0 : 1,
          unread: 0,
        };
        storeMessage(chatData);
      }).catch((err) => {
        Toast.error("Send message to channel failed.")
        console.error(err)
      })
    }else{
      Toast.error("Type a message");
      $("#messageText").focus();
    }


  })

  $("#send_peer_message").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      console.log("Please Login First");
      // Toast.error("Please Login First");
      return;
    }

    const params = serializeFormData("loginForm");

    if (!validator(params, ['appId', 'accountName', 'peerId', 'peerMessage'])) {
      return;
    }

    rtm.sendPeerMessage(params.peerMessage, params.peerId).then(() => {
      const view = $("<div/>", {
        text: "account: " + rtm.accountName + " send : " + params.peerMessage + " peerId: " + params.peerId
      });
      $("#log").append(view)
    }).catch((err) => {
      console.log("Send message to peer " + params.peerId + " failed, please open console see more details.")
      // Toast.error("Send message to peer " + params.peerId + " failed, please open console see more details.")
      console.error(err)
    })
  })

  $("#query_peer").on("click", function (e) {
    e.preventDefault();
    if (!rtm._logined) {
      console.log("Please Login First");
      // Toast.error("Please Login First");
      return;
    }

    const params = serializeFormData("loginForm");

    if (!validator(params, ['appId', 'accountName', 'memberId'])) {
      return;
    }

    rtm.queryPeersOnlineStatus(params.memberId).then((res) => {
      const view = $("<div/>", {
        text: "memberId: " + params.memberId + ", online: " + res[params.memberId]
      });
      $("#log").append(view)
    }).catch((err) => {
      console.log("query peer online status failed, please open console see more details.")
      // Toast.error("query peer online status failed, please open console see more details.")
      console.error(err)
    })
  })

  $(window).bind('beforeunload', function(){
    // Leave the channel
    rtm.leaveChannel(channelMD5).then(() => {

    }).catch((err) => {
      // Toast.error("Leave channel failed, please open console see more details.")
      // console.error(err)
    })
  });

  // Start the chatting
  initChat()

})

function initChat() {
  
  if (rtm._logined) {
    // console.log("You already logined");
    Toast.error("You already logined");
    return;
  }

  try {
    rtm.init(appId);
    window.rtm = rtm;
    rtm.login(userUID).then(() => {
      console.log('login')
      rtm._logined = true
      // Toast.notice("Logged in successfully");

      // Join the channel
      if (!rtm._logined) {
        // console.log("Please Login First");
        Toast.error("Please Login First");
        return;
      }

      if (rtm.channels[channelMD5] ||
        (rtm.channels[channelMD5] && rtm.channels[channelMD5].joined)) {
        Toast.error("You already joined");
        return;
      }
  
      rtm.joinChannel(channelMD5).then(() => {
        const view = $("<div/>", {
          text: rtm.accountName + " join channel success"
        });
        Toast.notice("You have joined the chat");
        $("#log").append(view);
        rtm.channels[channelMD5].joined = true;
      }).catch((err) => {
        // console.log("Join channel failed, please open console see more details.")
        Toast.error("Join channel failed, please open console see more details.")
        console.error(err)
      })

    }).catch((err) => {
      // console.log(err)
      Toast.error(err.message);
    })
  } catch(err) {
    // console.log("Login failed, please open console see more details");
    Toast.error("Login failed, please open console see more details");
    console.error(err);
  }

}

function getFullDate() {
  const currentTime = new Date();
  const year = currentTime.getFullYear();
  const month = currentTime.getMonth() > 8 ? (currentTime.getMonth() + 1) : '0'+(currentTime.getMonth() + 1);
  const day = currentTime.getDate() > 9 ? currentTime.getDate() : '0'+currentTime.getDate();
  const hours = currentTime.getHours() > 9 ? currentTime.getHours() : '0'+currentTime.getHours();
  const minutes = currentTime.getMinutes() > 9 ? currentTime.getMinutes() : '0'+currentTime.getMinutes();
  const fullDate = year +"-"+ month +"-"+ day +" "+ hours +":"+ minutes;
  return fullDate;
}


function storeMessage(data){
  $.ajax({
    method: "POST",
    url: "chat-message.php",
    data: data
  }).done(function(res) {
    
  }).fail(function(err) {
    console.error('error...',err);
  }).always(function() {
    // always called
  });	
}