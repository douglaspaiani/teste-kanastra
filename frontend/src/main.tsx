import React from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter } from 'react-router-dom'
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

//import * as Components from './components'
import NewTable from './components/ui/newTable';
import Uploader from './components/ui/uploader';
import { DataProvider } from './components/contexts/dataContext';


ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <BrowserRouter>
    <DataProvider>
      <ToastContainer />
      <Uploader/>
      <NewTable/>
    </DataProvider>  
    </BrowserRouter>
  </React.StrictMode>,
)
