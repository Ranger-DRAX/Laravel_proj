const AREAS = [
  'Mirpur', 'Shewrapara', 'Mohakhali', 'Banani', 'Gulshan-1', 'Gulshan-2', 'Badda'
];

// Demo restaurant data – in real app fetch from /api/restaurants?area=...
const TOTAL_SEATS=20;
const DEMO_RESTAURANTS = AREAS.flatMap(area => {
  const list = [];
  const count = Math.floor(Math.random()*2)+2; // 2-3 restaurants per area
  for (let i = 1; i <= count; i++) {
    list.push({
      id: `${area}-${i}`,
      name: `${area} Bistro ${i}`,
      area,
      rating: (Math.random() * 2 + 3).toFixed(1),
      img: `https://picsum.photos/seed/${encodeURIComponent(area+'-'+i)}/400/300`
    });
  }
  return list;
});

const areaFiltersDiv = document.getElementById('areaFilters');
const grid = document.getElementById('restaurantsGrid');
let activeArea = 'All';

function renderFilters() {
  ['All', ...AREAS].forEach(area => {
    const btn = document.createElement('button');
    btn.textContent = area;
    if (area === activeArea) btn.classList.add('active');
    btn.addEventListener('click', () => {
      activeArea = area;
      document.querySelectorAll('.filters button').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      renderGrid();
    });
    areaFiltersDiv.appendChild(btn);
  });
}

function renderGrid() {
  grid.innerHTML = '';
  const items = activeArea === 'All' ? DEMO_RESTAURANTS : DEMO_RESTAURANTS.filter(r => r.area === activeArea);
  items.forEach(r => {
    const card = document.createElement('div');
    card.className = 'card';
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    setTimeout(()=>{card.style.transition='all .4s ease';card.style.opacity=1;card.style.transform='translateY(0)';},10);
    card.innerHTML = `
      <img src="${r.img}" alt="${r.name}" onerror="this.src='https://via.placeholder.com/400x300?text=Restaurant'">
      <div class="card-body">
        <div class="card-title">${r.name}</div>
        <div class="card-location"><i class="fas fa-map-marker-alt"></i> ${r.area}</div>
        <div class="rating">${'★'.repeat(Math.round(r.rating))} (${r.rating})</div>
            <div class="seat-info" style="margin:6px 0;color:#4caf50;font-size:14px;">Loading seats...</div>
        <div class="card-footer"><button class="btn-book">Book</button></div>
      </div>`;
    card.querySelector('.btn-book').addEventListener('click', () => {
      window.location.href = `booking.html?rest=${encodeURIComponent(r.id)}&name=${encodeURIComponent(r.name)}`;
    });
    fetchSeatInfo(r,card.querySelector('.seat-info'));
    grid.appendChild(card);
  });
}

// helper functions for seat availability
function getToken(){return localStorage.getItem('token');}
async function fetchSeatInfo(rest,infoEl){
  try{
    const res=await fetch(`http://127.0.0.1:8000/api/client-bookings?restaurant=${encodeURIComponent(rest.name)}`,{headers:{'Authorization':'Bearer '+getToken(),'Accept':'application/json'}});
    let booked=0;
    if(res.ok){const arr=await res.json();booked=arr.length;}
    if(booked===0){booked=Math.floor(Math.random()*4)+2;} // default 2-5
    const avail=TOTAL_SEATS-booked;
    infoEl.textContent=`Seats Available: ${avail}/${TOTAL_SEATS}`;
    if(avail===0){infoEl.style.color='#bdbdbd';}
  }catch(e){infoEl.textContent='Seats data N/A';}
}

renderFilters();
renderGrid();
