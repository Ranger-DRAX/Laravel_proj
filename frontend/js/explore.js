const AREAS = [
  'Mirpur', 'Shewrapara', 'Mohakhali', 'Banani', 'Gulshan-1', 'Gulshan-2', 'Badda'
];

// Demo restaurant data – in real app fetch from /api/restaurants?area=...
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
        <div class="card-footer"><button class="btn-book">Book</button></div>
      </div>`;
    card.querySelector('.btn-book').addEventListener('click', () => {
      window.location.href = `booking.html?rest=${encodeURIComponent(r.id)}&name=${encodeURIComponent(r.name)}`;
    });
    grid.appendChild(card);
  });
}

renderFilters();
renderGrid();
