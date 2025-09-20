 
 
export default function Pagination({currentPage, lastPage}) {
 <div style={{ 
  display: 'flex',
  justifyContent: 'center',
  alignItems: 'center',
  gap: '1rem',
  marginTop: '2rem',
  fontFamily: 'Arial, sans-serif'
}}>
  <button
    onClick={handlePrevious}
    disabled={currentPage === 1}
    style={{
      padding: '0.5rem 1rem',
      borderRadius: '4px',
      border: 'none',
      backgroundColor: currentPage === 1 ? '#e0e0e0' : '#4285f4',
      color: currentPage === 1 ? '#a0a0a0' : 'white',
      cursor: currentPage === 1 ? 'not-allowed' : 'pointer',
      fontWeight: 'bold',
      transition: 'all 0.2s ease',
      minWidth: '80px'
    }}
    onMouseOver={e => {
      if (currentPage !== 1) e.currentTarget.style.backgroundColor = '#3367d6'
    }}
    onMouseOut={e => {
      if (currentPage !== 1) e.currentTarget.style.backgroundColor = '#4285f4'
    }}
  >
    Previous
  </button>
  
  <span style={{
    padding: '0.5rem 1rem',
    backgroundColor: '#f5f5f5',
    borderRadius: '4px',
    fontWeight: 'bold'
  }}>
    Page {currentPage} of {lastPage}
  </span>
  
  <button
    onClick={handleNext}
    disabled={currentPage === lastPage}
    style={{
      padding: '0.5rem 1rem',
      borderRadius: '4px',
      border: 'none',
      backgroundColor: currentPage === lastPage ? '#e0e0e0' : '#4285f4',
      color: currentPage === lastPage ? '#a0a0a0' : 'white',
      cursor: currentPage === lastPage ? 'not-allowed' : 'pointer',
      fontWeight: 'bold',
      transition: 'all 0.2s ease',
      minWidth: '80px'
    }}
    onMouseOver={e => {
      if (currentPage !== lastPage) e.currentTarget.style.backgroundColor = '#3367d6'
    }}
    onMouseOut={e => {
      if (currentPage !== lastPage) e.currentTarget.style.backgroundColor = '#4285f4'
    }}
  >
    Next
  </button>
</div>
 }