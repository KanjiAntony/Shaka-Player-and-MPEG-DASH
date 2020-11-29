// myapp.js

//var manifestUri = document.getElementById('url').innerHTML;
   // 'https://storage.googleapis.com/shaka-demo-assets/angel-one/dash.mpd';
   
   const player = "";
   
   var video;
   
    const myapp = {};

function initApp() {
  // Install built-in polyfills to patch browser incompatibilities.
  shaka.polyfill.installAll();

  // Check to see if the browser supports the basic APIs Shaka needs.
  if (shaka.Player.isBrowserSupported()) {
    // Everything looks good!
    init();
  } else {
    // This browser does not have the minimum set of APIs we need.
    console.error('Browser not supported!');
  }

}

function init() {
   // var manifestUri = "Uploaded/Videos/Cartoon/my_video_manifest.mpd";
   
   var manifestUri = document.getElementById('url').innerHTML;
   
  // When using the UI, the player is made automatically by the UI object.
  
  //const ui = new shaka.ui.Overlay(player, video, uiConfig);
  video = document.getElementById('video');
  
  const ui = video['ui'];
  
  var config = {
      addSeekBar: true,
      controlPanelElements: ['time_and_duration','mute', 'volume','spacer','Theatre','overflow_menu'],
      overflowMenuButtons: ['quality','picture_in_picture']
    };
    
    
    /*var array1 = ['rewind', 'fast_forward','Theatre'];
    
    config['controlPanelElements'] = array1;*/
    
     
    ui.configure(config);
  
  
  const controls = ui.getControls();
   const player = controls.getPlayer();

  // Listen for error events.
  player.addEventListener('error', onPlayerErrorEvent);
  controls.addEventListener('error', onUIErrorEvent);
 

  // Try to load a manifest.
  // This is an asynchronous process.
  try {
    player.load(manifestUri);
    // This runs if the asynchronous load is successful.
    console.log('The video has now been loaded!');


  } catch (error) {
    onPlayerError(error);
  }
}

      // Use shaka.ui.Element as a base class
 
myapp.FullscreenButton = class extends shaka.ui.Element {
  constructor(parent, controls) {
    super(parent, controls);

    // The actual button that will be displayed
    this.button_ = document.createElement('button');
    this.button_.textContent = 'Theatre';
   this.button_.innerHTML = '<i class = "fa fa-expand"></i>';
    this.parent.appendChild(this.button_);

    // Listen for clicks on the button to start the next playback
    this.eventManager.listen(this.button_, 'click', () => {
     
     
        toggleFullScreen();
     
     //console.log(window.fullScreen);
            
    });
  }
};

// Factory that will create a button at run time.
myapp.FullscreenButton.Factory = class {
  create(rootElement, controls) {
    return new myapp.FullscreenButton(rootElement, controls);
  }
};

// Register our factory with the controls, so controls can create button instances.
shaka.ui.Controls.registerElement(
  /* This name will serve as a reference to the button in the UI configuration object */ 'Theatre',
  new myapp.FullscreenButton.Factory());


function goFullScreen () {
//var elem = player;
var vide = document.getElementById('vid_container');

  if (vide.requestFullscreen) {
      vide.requestFullscreen();
      screen.orientation.lock("landscape");
    } else if (vide.msRequestFullscreen) {
      vide.msRequestFullscreen();
    } else if (vide.mozRequestFullScreen) {
      vide.mozRequestFullScreen();
    } else if (vide.webkitRequestFullscreen) {
      vide.webkitRequestFullscreen();
    }
    
    screen.orientation.lock("landscape");
}

function closeFullScreen() {
    
if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
  
}

function toggleFullScreen () {
//var elem = player;
var vide = document.getElementById('vid_container');

var isFull = (document.fullScreenElement && document.fullScreenElement !== null) ||  (document.mozFullScreen || document.webkitIsFullScreen);

  if (!isFull) {
      goFullScreen();
      //screen.orientation.lock("landscape");
    } else {
      closeFullScreen();      
    }
    
    //screen.orientation.lock("landscape");
}

//document.addEventListener('fullscreenchange', init);

function onErrorEvent(event) {
  // Extract the shaka.util.Error object from the event.
  onError(event.detail);
}

function onError(error) {
  // Log the error.
  console.error('Error code', error.code, 'object', error);
  //alert('Error code'+error.code+'object'+error);
}

function onPlayerErrorEvent(errorEvent) {
  // Extract the shaka.util.Error object from the event.
  onPlayerError(event.detail);
}

function onPlayerError(error) {
  // Handle player error
  console.error('Error code', error.code, 'object', error);
}

function onUIErrorEvent(errorEvent) {
  // Extract the shaka.util.Error object from the event.
  onPlayerError(event.detail);
}

function onCastStatusChanged(event) {
  // Handle cast status change
}

function initFailed() {
  // Handle the failure to load
  console.error('Unable to load the UI library!');
}


//document.addEventListener('DOMContentLoaded', initApp);

// Listen to the custom shaka-ui-loaded event, to wait until the UI is loaded.
document.addEventListener('shaka-ui-loaded', initApp);
// Listen to the custom shaka-ui-load-failed event, in case Shaka Player fails
// to load (e.g. due to lack of browser support).
document.addEventListener('shaka-ui-load-failed', initFailed);