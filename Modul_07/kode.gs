function doGet(e) {
  if (e && e.parameter && e.parameter.action) {
    const action = e.parameter.action;
    if (action === 'read') {
      return read();
    } else if (action === 'insert') {
      return insert_value(e);
    } else if (action === 'update') {
      return update_value(e);
    } else if (action === 'delete') {
      return delete_value(e);
    }
  }
  return ContentService.createTextOutput(JSON.stringify({ error: 'Invalid action' })).setMimeType(ContentService.MimeType.JSON);
}

function insert_value(e) {
  try {
    const ss = SpreadsheetApp.openById('YOUR_SPREADSHEET_ID'); // Replace with your spreadsheet ID
    const sheet = ss.getSheetByName('Lowongan Kerja');=[]
    
    // Get the next available ID_LOWONGAN
    const lastRow = sheet.getLastRow();
    const idLowongan = lastRow > 0 ? sheet.getRange(lastRow, 1).getValue() + 1 : 1; // Increment the last ID or start at 1

    const namaPerusahaan = e.parameter.NAMA_PERUSAHAAN || '';
    const posisi = e.parameter.POSISI || '';
    const lokasi = e.parameter.LOKASI || '';
    
    // Format BATAS_LAMARAN to a user-friendly format
    const batasLamaran = e.parameter.BATAS_LAMARAN ? new Date(e.parameter.BATAS_LAMARAN).toLocaleDateString() : '';

    sheet.appendRow([idLowongan, namaPerusahaan, posisi, lokasi, batasLamaran]);
    return ContentService.createTextOutput(JSON.stringify({ result: 'Insert successful' })).setMimeType(ContentService.MimeType.JSON);
  } catch (error) {
    Logger.log('Error inserting value: ' + error);
    return ContentService.createTextOutput(JSON.stringify({ error: error.message })).setMimeType(ContentService.MimeType.JSON);
  }
}

function read() {
  try {
    const ss = SpreadsheetApp.openById('YOUR_SPREADSHEET_ID'); // Replace with your spreadsheet ID
    const sheet = ss.getSheetByName('Lowongan Kerja');
    const data = sheet.getDataRange().getValues();
    const headers = data.shift();

    const jobs = data.map((row) => {
      const idLowongan = row[0];
      const parsedId = isNaN(idLowongan) ? null : parseInt(idLowongan);
      return {
        ID_LOWONGAN: parsedId,
        NAMA_PERUSAHAAN: row[1],
        POSISI: row[2],
        LOKASI: row[3],
        BATAS_LAMARAN: row[4]
      };
    });

    return ContentService.createTextOutput(JSON.stringify(jobs)).setMimeType(ContentService.MimeType.JSON);
  } catch (error) {
    Logger.log('Error reading data: ' + error);
    return ContentService.createTextOutput(JSON.stringify({ error: error.message })).setMimeType(ContentService.MimeType.JSON);
  }
}

function update_value(e) {
  try {
    const ss = SpreadsheetApp.openById('YOUR_SPREADSHEET_ID'); // Replace with your spreadsheet ID
    const sheet = ss.getSheetByName('Lowongan Kerja');
    const idLowongan = e.parameter.ID_LOWONGAN;

    const data = sheet.getDataRange().getValues();
    let rowIndex = -1;

    // Find the row with the matching ID_LOWONGAN
    for (let i = 0; i < data.length; i++) {
      if (data[i][0] == idLowongan) {
        rowIndex = i + 1; // +1 because getValues() is 0-indexed but rows are 1-indexed
        break;
      }
    }

    if (rowIndex === -1) {
      return ContentService.createTextOutput(JSON.stringify({ error: 'ID_LOWONGAN not found' })).setMimeType(ContentService.MimeType.JSON);
    }

    const namaPerusahaan = e.parameter.NAMA_PERUSAHAAN || '';
    const posisi = e.parameter.POSISI || '';
    const lokasi = e.parameter.LOKASI || '';
    const batasLamaran = e.parameter.BATAS_LAMARAN ? new Date(e.parameter.BATAS_LAMARAN).toLocaleDateString() : '';

    // Update the row with new values
    sheet.getRange(rowIndex, 2, 1, 4).setValues([[namaPerusahaan, posisi, lokasi,
        batasLamaran]]);
    
    return ContentService.createTextOutput(JSON.stringify({ result: 'Update successful' })).setMimeType(ContentService.MimeType.JSON);
  } catch (error) {
    Logger.log('Error updating value: ' + error);
    return ContentService.createTextOutput(JSON.stringify({ error: error.message })).setMimeType(ContentService.MimeType.JSON);
  }
}

function delete_value(e) {
  try {
    const ss = SpreadsheetApp.openById('YOUR_SPREADSHEET_ID'); // Replace with your spreadsheet ID
    const sheet = ss.getSheetByName('Lowongan Kerja');
    const idLowongan = e.parameter.ID_LOWONGAN;

    const data = sheet.getDataRange().getValues();
    let rowIndex = -1;

    // Find the row with the matching ID_LOWONGAN
    for (let i = 0; i < data.length; i++) {
      if (data[i][0] == idLowongan) {
        rowIndex = i + 1; // +1 because getValues() is 0-indexed but rows are 1-indexed
        break;
      }
    }

    if (rowIndex === -1) {
      return ContentService.createTextOutput(JSON.stringify({ error: 'ID_LOWONGAN not found' })).setMimeType(ContentService.MimeType.JSON);
    }

    // Delete the row
    sheet.deleteRow(rowIndex);
    
    return ContentService.createTextOutput(JSON.stringify({ result: 'Delete successful' })).setMimeType(ContentService.MimeType.JSON);
  } catch (error) {
    Logger.log('Error deleting value: ' + error);
    return ContentService.createTextOutput(JSON.stringify({ error: error.message })).setMimeType(ContentService.MimeType.JSON);
  }
}