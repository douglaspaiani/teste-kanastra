// src/components/CSVUploader.js
import React, { useRef, useState } from 'react';
import axios from 'axios';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import '../css/Uploader.css';


const Uploader = () => {
    const [file, setFile] = useState(null);
    const fileInputRef = useRef(null);

    const handleFileChange = (event) => {
        setFile(event.target.files[0]);
    };

    const handleSubmit = async (event) => {
        event.preventDefault();
        const formData = new FormData();
        formData.append('file', file);

        try {
            const response = await axios.post('http://127.0.0.1:8000/api/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            toast.success("Arquivo enviado com sucesso!");
            setFile(null);
            if (fileInputRef.current) {
                fileInputRef.current.value = "";
            }
        } catch (error) {
            toast.error("Erro ao enviar o arquivo.");
            console.error('Erro ao enviar o arquivo:', error);
        }
    };

    return (
        <div>
            <h1>Upload de CSV</h1>
            <form onSubmit={handleSubmit}>
                <input type="file" accept=".csv" onChange={handleFileChange} ref={fileInputRef} />
                <button type="submit">Enviar arquivo</button>
            </form>
        </div>
    );
};

export default Uploader;
