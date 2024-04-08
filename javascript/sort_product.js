function handleSort(select) {
    const selectedOption = select.value;
    window.location.href = `?sort=${selectedOption}`;
}