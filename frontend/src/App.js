import React from 'react';
import FilmsTable from "./component/FilmsTable";
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
  return (
      <div className="App">
          <div className="container-lg mb-5">
              <FilmsTable />
          </div>
      </div>
  );
}

export default App;
