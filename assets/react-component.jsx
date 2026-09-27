const rootEl=document.getElementById('reactFeature');
if(rootEl && window.React && window.ReactDOM){
  function Shortlist(){
    const [count,setCount]=React.useState((window.session?.interests||[]).length);
    React.useEffect(()=>{const refresh=()=>setCount((window.session?.interests||[]).length);window.addEventListener('interestChanged',refresh);const t=setInterval(refresh,500);return()=>{window.removeEventListener('interestChanged',refresh);clearInterval(t)}}},[]);
    return React.createElement('div',{className:'react-shortlist-inner'},React.createElement('strong',null,'React shortlist: '),count+' saved '+(count===1?'property':'properties'));
  }
  ReactDOM.createRoot(rootEl).render(React.createElement(Shortlist));
}
