const grid=document.getElementById('propertyGrid');
const authModalEl=document.getElementById('authModal');
const count=document.getElementById('resultCount');
const empty=document.getElementById('emptyState');
let session={logged_in:false,interests:[]};

async function loadSession(){const r=await fetch('api/session.php');session=await r.json();document.getElementById('userGreeting').textContent=session.logged_in?`Hi, ${session.name}`:'';}
function getBudget(){const v=document.getElementById('budget').value;if(!v)return [0,999999];return v.split('-').map(Number);}
async function loadProperties(){
 grid.innerHTML='<div class="col-12 text-center py-5">Loading properties...</div>';
 const [min,max]=getBudget(); const p=new URLSearchParams({city:document.getElementById('city').value,gender:document.getElementById('gender').value,min_price:min,max_price:max});
 const r=await fetch('api/properties.php?'+p); const data=await r.json(); count.textContent=`${data.length} properties`;
 empty.classList.toggle('d-none',data.length!==0);
 grid.innerHTML='';
 data.forEach(x=>{
  const div=document.createElement('div');div.className='col-md-6 col-lg-4';
  const interested=session.interests.map(Number).includes(Number(x.id));
  div.innerHTML=`<div class="property-card">
   <img src="${x.image_url}" class="w-100" alt="${x.name}">
   <div class="p-3 d-flex flex-column h-100"><div class="d-flex justify-content-between gap-2"><h3 class="h5">${x.name}</h3><span class="badge text-bg-light">${x.gender}</span></div>
   <div class="small text-secondary mb-2">${x.area}, ${x.city}</div><div class="price mb-2">₹${Number(x.price).toLocaleString('en-IN')} / month</div>
   <div class="small mb-3">★ ${x.rating} / 5</div><p class="small text-secondary mb-3">${x.description}</p>
   <div class="property-actions" style="display:flex!important;gap:8px!important;margin-top:12px!important;padding-top:12px!important;border-top:1px solid #e9eef5!important;visibility:visible!important;opacity:1!important;">
     <a href="property.php?id=${x.id}" class="btn btn-primary btn-sm" style="display:inline-flex!important;align-items:center!important;justify-content:center!important;visibility:visible!important;opacity:1!important;flex:1 1 auto!important;">View details</a>
     <button type="button" class="btn btn-outline-primary btn-sm interest-btn" onclick="toggleInterest(${x.id}, this)" style="display:inline-flex!important;align-items:center!important;justify-content:center!important;visibility:visible!important;opacity:1!important;min-width:125px!important;white-space:nowrap!important;"><span class="interest-label" style="display:inline!important;visibility:visible!important;opacity:1!important;">${interested?'♥ Saved':'♡ Interested'}</span></button>
   </div></div></div>`;
  grid.appendChild(div);
 });
}
async function toggleInterest(id,btn){
 if(!session.logged_in){ bootstrap.Modal.getOrCreateInstance(authModalEl).show(); return; }
 const fd=new FormData();fd.append('action','toggle');fd.append('property_id',id);btn.disabled=true;
 const r=await fetch('api/interest.php',{method:'POST',body:fd});const d=await r.json();btn.disabled=false;
 if(d.success){btn.querySelector('.interest-label').textContent=d.interested?'♥ Saved':'♡ Interested';if(d.interested)session.interests.push(id);else session.interests=session.interests.filter(x=>Number(x)!==Number(id));window.dispatchEvent(new Event('interestChanged'));}
}
document.getElementById('filterBtn').onclick=loadProperties;
document.getElementById('loginForm').onsubmit=async e=>{e.preventDefault();const fd=new FormData(e.target);fd.append('action','login');const d=await (await fetch('api/auth.php',{method:'POST',body:fd})).json();document.getElementById('authMessage').textContent=d.message;if(d.success){await loadSession();bootstrap.Modal.getInstance(document.getElementById('authModal')).hide();loadProperties();}};
document.getElementById('signupForm').onsubmit=async e=>{e.preventDefault();const fd=new FormData(e.target);fd.append('action','signup');const d=await (await fetch('api/auth.php',{method:'POST',body:fd})).json();document.getElementById('authMessage').textContent=d.message;if(d.success){await loadSession();bootstrap.Modal.getInstance(document.getElementById('authModal')).hide();loadProperties();}};
loadSession().then(loadProperties);