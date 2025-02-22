<div class="row mb-4">
    <div class="col text-end">
        <img src="/api/placeholder/150/80" alt="Fayyaz Travels Logo" class="logo">
    </div>
</div>

<form class="needs-validation" novalidate>
    <div class="card">
        <div class="card-header bg-warning text-center">
            <h4 class="mb-0">E-VISA APPLICATION FORM</h4>
            <small>Please complete the following application in CAPITAL LETTERS AND SELECT FROM LIST WHERE NECESSARY</small>
        </div>

        <div class="card-body">
            <!-- Personal Information Section -->
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Full Name (as shown in passport)</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of birth</label>
                    <input type="date" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male">
                            <label class="form-check-label">MALE</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="female">
                            <label class="form-check-label">FEMALE</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Race</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country of birth</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nationality</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Religion</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Marital Status</label>
                    <select class="form-select" required>
                        <option value="">Select...</option>
                        <option>Single</option>
                        <option>Married</option>
                        <option>Divorced</option>
                        <option>Widowed</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Nationality of Spouse (If married)</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <!-- Travel Document Section -->
            <div class="section-header mt-4">
                <h5 class="mb-0">TRAVEL DOCUMENT NUMBER</h5>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Type of Passport</label>
                    <select class="form-select" required>
                        <option value="">Select...</option>
                        <option>Ordinary</option>
                        <option>Diplomatic</option>
                        <option>Service</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Country of Issue</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Place of Issue</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Passport Number</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Issue Date</label>
                    <input type="date" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Expiry Date</label>
                    <input type="date" class="form-control" required>
                </div>
            </div>

            <!-- Address Section -->
            <div class="section-header mt-4">
                <h5 class="mb-0">ADDRESS IN COUNTRY OF ORIGIN / RESIDENCE</h5>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Country of Origin</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Permanent address in hometown</label>
                    <textarea class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <!-- Occupation and Education Section -->
            <div class="section-header">
                <h5 class="mb-0">OCCUPATION AND EDUCATION INFORMATION OF APPLICANT</h5>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Occupation</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Annual Income of Applicant SGD</label>
                    <input type="number" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address of Applicant</label>
                    <input type="email" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Contact Number of Applicant</label>
                    <input type="tel" class="form-control" placeholder="Include country code" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Highest Academic/Professional Qualifications Attained</label>
                    <input type="text" class="form-control" required>
                </div>
            </div>

            <!-- Information of Visit Section -->
            <div class="section-header">
                <h5 class="mb-0">INFORMATION OF VISIT</h5>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Expected Date of Arrival</label>
                    <input type="date" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Inflight Number</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Type of Visa</label>
                    <select class="form-select" required>
                        <option value="">Select...</option>
                        <option>Tourist</option>
                        <option>Business</option>
                        <option>Student</option>
                        <option>Work</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">How long does the applicant intend to stay in Singapore?</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">How many days is the applicants intended stay?</label>
                    <input type="number" class="form-control" placeholder="i.e. 5 days" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Date of Departure</label>
                    <input type="date" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Outflight Number</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Purpose of Visit</label>
                    <select class="form-select mb-2" required>
                        <option value="">Choose a purpose</option>
                        <option>Tourism</option>
                        <option>Business</option>
                        <option>Family Visit</option>
                        <option>Other</option>
                    </select>
                    <input type="text" class="form-control" placeholder="If Other, please specify">
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="section-header">
                <h5 class="mb-0">ADDITIONAL INFORMATION - THIS CAN BE COPIED FROM RELATIVE RELATION NOTEPAD</h5>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Is the Applicant Travelling Alone?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="travellingAlone" value="yes">
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="travellingAlone" value="no">
                        <label class="form-check-label">No</label>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">If No, please indicate applicants relationship with other travelers and their passport numbers</label>
                    <div class="example-text mb-2">i.e. Husband (V368221), Children (T429401, T389202) and Mother (X590307)</div>
                    <textarea class="form-control" rows="3"></textarea>
                </div>
            </div>

            <!-- Singapore Address Section -->
            <div class="section-header">
                <h5 class="mb-0">APPLICANTS ADDRESS IN SINGAPORE</h5>
            </div>

            <div class="row g-3 mt-2 mb-4">
                <div class="col-12">
                    <label class="form-label">Where will the applicant be staying?</label>
                    <input type="text" class="form-control" required>
                </div>

                <div class="col-12">
                    <label class="form-label">Hotel / Building Name</label>
                    <input type="text" class="form-control" required>
                </div>
            </div>
            <!-- Antecedent Section -->
            <div class="container mt-4">
                <div class="section-header">
                    <h5 class="mb-0">ANTECEDENT OF APPLICANT</h5>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-12">
                        <label class="form-label">
                            Has the applicant ever resided in countries other than the country of origin for 1 year or more in the last 5 years? If Yes, Please provide (Country, Address, Period of stay)
                            <span class="important-field">*IMPORTANT</span>
                        </label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="col-12">
                        <div class="yes-no-group mb-2">
                            <label class="form-label">Has the applicant ever been refused entry into or deported from any country, including Singapore?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="refused" value="yes">
                                <label class="form-check-label">YES</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="refused" value="no">
                                <label class="form-check-label">NO</label>
                            </div>
                        </div>

                        <div class="yes-no-group mb-2">
                            <label class="form-label">Has the applicant ever been convicted in a court of law in any country, including Singapore?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="convicted" value="yes">
                                <label class="form-check-label">YES</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="convicted" value="no">
                                <label class="form-check-label">NO</label>
                            </div>
                        </div>

                        <div class="yes-no-group mb-2">
                            <label class="form-label">Has the applicant ever been prohibited from entering Singapore?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prohibited" value="yes">
                                <label class="form-check-label">YES</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prohibited" value="no">
                                <label class="form-check-label">NO</label>
                            </div>
                        </div>

                        <div class="yes-no-group mb-2">
                            <label class="form-label">Has the applicant ever entered Singapore using a different passport or name?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="different_passport" value="yes">
                                <label class="form-check-label">YES</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="different_passport" value="no">
                                <label class="form-check-label">NO</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">If any of the answer is 'Yes', please furnish details below:</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">
                            Which country is the applicant travelling from before arriving to Singapore?
                            <span class="important-field">*IMPORTANT</span>
                        </label>
                        <input type="text" class="form-control" required>
                    </div>
                </div>

                <!-- Declaration Section -->
                <div class="row g-3 mt-4">
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-3 border p-3">
                            <div class="flex-grow-1">
                                <strong>*I hereby declare that all information provided is correct and accurate.</strong>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" required>
                                <label class="form-check-label">I AGREE</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="alert alert-warning">
                            <small>
                                *Please check the v14a form from the ICA website to ensure all information has been added is correct.<br>
                                (1) If any information is incorrect, it is the responsibility of the agent/applicant.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="section-header">
                        <h5 class="mb-0">DECLARATION AND TERMS</h5>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-12">
                            <div class="d-flex align-items-start gap-3 border p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required>
                                </div>
                                <div>
                                    <strong>*I hereby declare that all information provided is correct and accurate.</strong>
                                </div>
                                <div class="ms-auto">
                                    <span class="badge bg-danger">FALSE</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            *Please check the v14a form from the ICA website to ensure all information has been added is correct.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (1) If any information is incorrect, it is the responsibility of the agent/applicant.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (2) Any false or erroneous information will result in penalties from Fayyaz Travels and ICA respectively based on discretion.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (3) All applications received need to be checked and verified by the agent, if there is an error in submission from FayyazTravels it needs to be reported within 24 hrs of the E-Visa being received to avoid inconvenience to the client. Any errors reported after 24hrs will be the responsibility of agent/applicant.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (4) If there is any fradulent or suspicious application submitted, your account will be suspended immediately upon ICA's first notice until an investigation is complete. Account will resume normal function only when the agent has been cleared.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (5) If found guilty, your deposit will be withdrawn and there will be no refund of remaining monies.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (6) It is the agent's responsibility to verify all the information, documentation and interview the clients in person before submitting the information to Fayyaz Travels for their application.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (7) Fayyaz Travels bears no responsibility if the information provided to them is incorrect from applicant or agent and all fees and penalties resulting from the same will be passed on to the agent.
                                        </label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" required>
                                        <label class="form-check-label">
                                            (8) Details of Any Previous Singapore Visa Rejections (if applicable)
                                        </label>
                                        <input type="text" class="form-control mt-2">
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            (9) Are you also looking for land packages?
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <!-- <button type="submit" class="btn btn-primary w-100">Submit Application</button> -->

                            <button type="submit" class="btn cta-button btn-disabled btn-lg rounded-pill p-3 plexFont fw-bold fs-6" id="saveNextBtnDocs" disabled>
                                Save and Next <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- don't delete below -->
            </div>
        </div>
</form>