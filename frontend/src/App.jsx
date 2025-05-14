import { useEffect, useState } from 'react'
import './App.css'

function App() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch('http://localhost/User-Session-Estimation-System-Project/backend/analyze.php')
      .then(response => response.json())
      .then(data => {
        console.log(data);
        setUsers(data);
      })
      .catch(error => console.error('Veri çekilirken hata oluştu:', error));
  }, []);

  return (
    <>
      <div className='container'>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Last Login</th>
              <th>Prediction 1 (Avg Interval)</th>
              <th>Prediction 2(Pattern)</th>
            </tr>
          </thead>
          <tbody>
            {users.map((user, index) => (
              <tr key={index}>
                <td >{user.name}</td>
                <td >{user.lastLogin}</td>
                <td >{user.predictionAvgInterval}</td>
                <td >{user.predictionPattern}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>

    </>
  )
}

export default App