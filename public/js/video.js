let videolists = document.querySelectorAll('.lists');
  videolists.forEach(video=>{
    video.onclick= () =>{
      let src = video.querySelector('.vid').src;
      let description = video.querySelector('.dex').innerHTML;
      document.querySelector('.mainvid').src = src;
      document.querySelector('.desc').innerHTML = description;
    };
  });

