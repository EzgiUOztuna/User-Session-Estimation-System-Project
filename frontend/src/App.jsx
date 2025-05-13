import { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch('http://localhost/User-Session-Estimation-System-Project/backend/api.php')
      .then(response => response.json())
      .then(data => {
        console.log(data);
        setUsers(Array.isArray(data) ? data : []);
      })
      .catch(error => console.error('Veri çekilirken hata oluştu:', error));
  }, []);

  return (
    <>



    </>
  )
}

export default App
