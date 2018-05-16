function setZero()
{
  document.form1.nou.value = 2;
}

function addSite()
{
  if (document.form1.nou.value > 13)
  {}else{
    var i = document.form1.nou.value;
    document.form1.nou.value = ++i;
    show(document.form1.nou.value);
  }
}

function removeSite()
{
  if (document.form1.nou.value == 0)
  {}else{
    hide(document.form1.nou.value);
    var i = document.form1.nou.value;
    document.form1.nou.value = --i;
  }
}
