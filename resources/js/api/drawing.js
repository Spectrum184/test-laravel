export function getDrawings({ type, keyword, limit, jwtToken }) {
  return fetch(
    `http://localhost:5000/api/drawing/searchDrawing?keyword=${keyword}&type=${type}&limit=${limit}`,
    {
      method: 'GET',
      headers: {
        Authorization: jwtToken,
      },
    }
  ).then(response => response.json());
}
