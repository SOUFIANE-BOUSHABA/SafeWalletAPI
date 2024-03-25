
export default function Retrait() { 


    return (
        <div className="container mt-4">
            <div className="row mt-4">
                <div className="col-md-6 offset-md-3">
                    <div className="card">
                        <div className="card-body">
                            <h2 className="card-title">Retrait</h2>
                            
                            <form>
                                
                                <div className="mb-3">
                                    <label htmlFor="number" className="form-label">Montant</label>
                                    <input type="number" className="form-control" id="number" />
                                </div>
                                
                                <button type="submit" className="btn btn-primary">Retirer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );

}