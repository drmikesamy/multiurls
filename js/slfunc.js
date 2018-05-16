function sl(urlno)
{
  ct = 0;
  turlno = urlno;
  lt = setInterval("corc()",50);
}
function corc()
{
  if(ct == "1")
  {
    clearInterval(lt);
  }else{
    var navi = navigator.appName;
    if(navi == "Netscape")
    {
      window.stop();
    }else{
      document.execCommand('Stop');
    }
    document.getElementById("uln"+turlno).innerHTML = "Done";
    if(turlno == nou)
    {
      if(col == "false")
      {
        showall();
      }
      hide('pl');
    }
    for(x=0;x<=nou;x++)
    {
      if(turlno == x)
      {
        eval("f"+x+"l();");
      }
    }
    document
    ct++;
  }
}
function showall(){for(x=0;x<=nou;x++){show("content"+x);}}
function hideall(){for(x=0;x<=nou;x++){hide("content"+x);}}
function rlall(){document.getElementById('frame0').src="pages/pf.php?url="+document.getElementById('urlbox0').value+"&urlno=0";}
function saveURLs()
{
  for(x=0;x<=nou;x++)
  {
    var boxurl = document.getElementById('urlbox'+x).value;
    if(boxurl.match(/(http|https|ftp):.*/))
    {
      document.getElementById('durl'+x).value = document.getElementById('urlbox'+x).value;
    }else{
      document.getElementById('durl'+x).value = "http://"+document.getElementById('urlbox'+x).value;
    }
  }
  document.saveForm.submit();
}
function eUpdateURL(event,bnum)
{
  var whichk = event.keyCode || event.which;
  if(whichk == 13)
  {
    cUpdateURL(bnum);
  }
}
function cUpdateURL(bnum)
{
  var boxurl = document.getElementById('urlbox'+bnum).value;
  if(boxurl.match(/(http|https|ftp):.*/))
  {
    document.getElementById('frame'+bnum).src="pages/pf.php?url="+document.getElementById('urlbox'+bnum).value;
  }else{
    document.getElementById('urlbox'+bnum).value="http://"+document.getElementById('urlbox'+bnum).value;
    document.getElementById('frame'+bnum).src="pages/pf.php?url="+document.getElementById('urlbox'+bnum).value;
  }
}
